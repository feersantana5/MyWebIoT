<?php

namespace App\Http\Controllers;
use App\Payment;
use App\Producto;
use App\Orden;


use Illuminate\Http\Request;

class ShopController extends Controller
{
    public function listaProductos()
    {
        $productos = Producto::get();

        return view('/shopAdmin')
            ->with('productos', $productos);
    }


    //PRODUCTO BACKEND

    public function crearProducto()
    {

        return view("crearProducto");
    }

    /**
     * Procesa el formulario de creacion de producto
     */
    public function procesar_producto()
    {
        if (isset($_POST['nombreProducto'], $_POST['descripcionProducto'], $_POST['precioProducto'], $_POST['stockProducto'])) {

            $producto = new Producto();
            $producto->nombreProducto = $_POST['nombreProducto'];
            $producto->descripcionProducto = $_POST['descripcionProducto'];
            $producto->precioProducto = $_POST['precioProducto'];
            $producto->stockProducto = $_POST['stockProducto'];
            $producto->save();

            return redirect('/shopAdmin')->with('exito', 'Se ha añadido el producto ' . $_POST['stockProducto']);
        } else {
            return back()->with('error', 'Se ha añadido el producto ' . $_POST['stockProducto']);
        }
    }

    public function actualizarProducto()
    {
        if (isset($_GET['idProducto'])) {
            return view('actualizarProducto', ['id' => $_GET['idProducto']]);
        }
    }

    /**
     * Procesa el formulario de actualizacion de producto
     */
    public function procesar_producto_actualizado()
    {
        if (isset($_POST['idProducto'])) {
            $producto = Producto::where('id', $_POST['idProducto'])
                ->first();

            if ($_POST['nombreProducto'] != "") {
                $producto->nombreProducto = $_POST['nombreProducto'];
            }
            if ($_POST['descripcionProducto'] != "") {
                $producto->descripcionProducto = $_POST['descripcionProducto'];
            }
            if ($_POST['precioProducto'] != "") {
                $producto->precioProducto = doubleval($_POST['precioProducto']);
            }
            if ($_POST['stockProducto'] != "") {
                $producto->stockProducto = doubleval($_POST['stockProducto']);
            }
            $producto->save();
            return redirect('/shopAdmin')->with('exito', 'Se ha editado el producto ' . $producto->nombreProducto . ' correctamente');
        }
    }

    /**
     * Elimina el producto deseado desde shopAdmin
     */
    public function eliminarProducto()
    {
        if (isset($_GET['idProducto'])) {
            Producto::where('id', $_GET['idProducto'])
                ->first()
                ->delete();
            return redirect('/shopAdmin')->with('exito', 'Se ha eliminado el producto correctamente');
        }
    }


    /**
     * permite ver los detalles del producto deseado desde shop y adminShop
     */
    public function consultarProducto()
    {
        if (isset($_GET['idProducto'])) {
            return view('producto', ['id' => $_GET['idProducto']]);
        }
    }



    public function listaOrdenes()
    {
        $ordenes = Orden::get();

        return view("ordenes")
            ->with('ordenes', $ordenes);
    }


    public function listaTransacciones()
    {
        $transacciones = Payment::get();

        return view("transacciones")
            ->with('transacciones', $transacciones);
    }

    //CARRITO

    public function miCarrito()
    {
        $productos = Producto::get();

        if (session('carrito') == null) {
            //Crear  carrito
            session(["carrito" => 'OK']);
        }

        return view('carrito')
            ->with('productos', $productos);
    }


    /**
     * ajax que actualiza el numero de productos en el carrito #TODO
     */
    public function numero_carrito()
    {
        $data = session()->all();
        $NelementosCarro = 0;
        foreach ($data as $key => $valor) {
            if ($key[0] == 'P') {
                $NelementosCarro += $valor;
            }
        }
        echo $NelementosCarro;
    }


    public function addCarrito()
    {

        if (isset($_POST['idProducto'], $_POST['cantidad'])) {
            $productoStock = Producto::where('id', $_POST['idProducto'])->first();

            $producto = "PROD-" . $_POST['idProducto'];
            if (session($producto) != null) {
                $cantidadAntes = session($producto);
                $cantidadActual = $cantidadAntes + $_POST['cantidad'];
                if ($productoStock->stockProducto < $cantidadActual) {
                    return redirect('/shop')->with('error', 'No hay suficientes unidades en stock');
                }
                session([$producto => $cantidadActual]);

            } else {
                if ($productoStock->stockProducto < $_POST['cantidad']) {
                    return redirect('/shop')->with('error', 'No hay suficientes unidades en stock');
                }
                session([$producto => $_POST['cantidad']]);
            }
            return redirect('/shop')->with('exito', 'Se ha añadido ' . $_POST['cantidad'] . ' producto(s) al carrito');
        }
        return redirect('/shop')->with('error', 'Error al añadir en el carrito');
    }


    public function vaciarCarrito()
    {
        $datos = session()->all();
        foreach ($datos as $producto => $cantidad) {
            if (substr($producto, 0, 5) == 'PROD-') {
                session()->forget($producto);       //eliminamos todas las sesiones que comiencen por PROD- (carrito)
            }
        }
        return redirect('/shop')->with('exito', 'Se ha vaciado el carrito');
    }

    public function eliminarProductoCarrito()
    {
        if (isset($_GET['idProducto'])) {
            $producto = Producto::where('id', $_GET['idProducto'])->first();
            session()->forget('PROD-' . $_GET['idProducto']);
        }

        return view('shop')->with('exito', 'Se ha eliminado del carrito '.$producto->nombreProducto);
    }

    public function verCheckout()
    {
        $productos = Producto::get();

        return view("checkout")
            ->with('productos', $productos);
    }

}
