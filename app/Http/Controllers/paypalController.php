<?php

namespace App\Http\Controllers;

use App\OrdenDetalle;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;
use PayPal\Api\Amount;
use PayPal\Api\Payer;
use PayPal\Api\Payment;
use PayPal\Api\PaymentExecution;
use PayPal\Api\RedirectUrls;
use PayPal\Api\Transaction;
use PayPal\Auth\OAuthTokenCredential;
use PayPal\Exception\PayPalConnectionException;
use PayPal\Rest\ApiContext;
use App\Producto;
use App\Orden;


class paypalController extends Controller
{
    private $apiContext;

    public function __construct()
    {
        $payPalConfig = Config::get('paypal');

        $this->apiContext = new ApiContext(
            new OAuthTokenCredential(
                $payPalConfig['client_id'],
                $payPalConfig['secret']
            )
        );

        $this->apiContext->setConfig($payPalConfig['settings']);
    }

    // ...

    public function payWithPayPal()
    {
        $payer = new Payer();
        $payer->setPaymentMethod('paypal');


        $cantidad = session('total');
        $amount = new Amount();
        $amount->setTotal(session('total'));
        $amount->setCurrency('EUR');

        $transaction = new Transaction();
        $transaction->setAmount($amount);
        // $transaction->setDescription('See your IQ results');

        $callbackUrl = url('/paypal/status');

        $redirectUrls = new RedirectUrls();
        $redirectUrls->setReturnUrl($callbackUrl)
            ->setCancelUrl($callbackUrl);

        $payment = new Payment();
        $payment->setIntent('sale')
            ->setPayer($payer)
            ->setTransactions(array($transaction))
            ->setRedirectUrls($redirectUrls);

        try {
            $payment->create($this->apiContext);
            return redirect()->away($payment->getApprovalLink());
        } catch (PayPalConnectionException $ex) {
            echo $ex->getData();
        }
    }

    public function payPalStatus(Request $request)
    {
        $paymentId = $request->input('paymentId');
        $payerId = $request->input('PayerID');
        $token = $request->input('token');

        if (!$paymentId || !$payerId || !$token) {
            $status = 'Lo sentimos! El pago a través de PayPal no se pudo realizar.';
            return redirect('/shop')->with('error', $status);
        }

        $payment = Payment::get($paymentId, $this->apiContext);
        $transaction = $payment->getTransactions();
        $amount = $transaction[0]->getAmount()->getTotal();
        $email= $payment->getPayer()->getPayerInfo()->getEmail();
        $execution = new PaymentExecution();
        $execution->setPayerId($payerId);

        /** Execute the payment **/
        $result = $payment->execute($execution, $this->apiContext);

        if ($result->getState() === 'approved') {

            //Insertar en BD
            $orden = new Orden();
            $orden->id_cliente = session('user');
            $orden->precioTotal = session('total');
            $orden->estadoOrden = "COMPLETADO";
            $orden->save();

            //Insertar en BD

            $payment = new \App\Payment();
            $payment->orderId = $orden->id;
            $payment->payerId = $payerId;
            $payment->amount = $amount;
            $payment->token = $token;
            $payment->paymentId = $paymentId;
            $payment->email = $email;
            $payment->save();

            //Insertar en BD
            $this->orderDetalle($orden->id_cliente);

            $status = 'Gracias! El pago a través de PayPal se ha ralizado correctamente.';

            $this->vaciarCarrito();

            return redirect('/shop')->with('exito', $status);
        }

        $status = 'Lo sentimos! El pago a través de PayPal no se pudo realizar.';
        return redirect('/shop')->with('error', $status);
    }

    public function orderDetalle($ordenID) {
        $datos = session()->all();
        foreach ($datos as $producto => $cantidad) {
            if(substr($producto, 0, 5) == 'PROD-') {
                $prodID = substr($producto, 5);
                $producto = Producto::where('id', $prodID)->first();

                //Actualizar stock
                $producto->stockProducto -= $cantidad;
                $producto->save();

                $ordenDetalle = new OrdenDetalle();
                $ordenDetalle->id_orden = $ordenID;
                $ordenDetalle->id_producto = $prodID;
                $ordenDetalle->cantidadProducto = $cantidad;
                $ordenDetalle->save();
            }
        }
    }

    public function vaciarCarrito() {
        $datos = session()->all();
        foreach ($datos as $producto => $cantidad) {
            if(substr($producto, 0, 5) == 'PROD-') {
                session()->forget($producto);
            }
        }
    }


}
