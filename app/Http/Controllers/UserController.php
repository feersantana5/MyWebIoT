<?php

namespace App\Http\Controllers;

use App\Usuario;
use App\Canal;
use App\Sensor;
use App\Atencion;


use Illuminate\Http\Request;


class UserController extends Controller
{

    public function register()
    {
        return view("register");
    }

    public function login()
    {
        return view("login");
    }

    public function canales()
    {
        return view("canales");

    }

    public function crearCanal()
    {
        return view("crearCanal");
    }

    public function misCanales()
    {
        return view("misCanales");
    }

    public function datosSWSensor()
    {
        return view("datosSWSensor");
    }
    public function servicioWeb()
    {
        return view("servicioWeb");
    }

    public function capacidad_datos()
    {
        // Parámetros de conexión a la BD
        $server = "localhost";
        $user = "root";
        $database = "l1_pweb";
        $pass = "";

        //CONECTAMOS CON LA BASE DE DATOS. SE CREA UN OBJETO
        $connection = mysqli_connect($server, $user, $pass, $database);

        //Comprobacion errores
        if (mysqli_connect_errno()) {
            die(mysqli_connect_error());
        }

        //Datos para la gráfica
        $sql = 'SHOW TABLE STATUS';

        if ($result = mysqli_query($connection, $sql)) {
            $sizebd = 0;

            while ($row = mysqli_fetch_array($result)) {
                $sizebd += $row["Data_length"] + $row["Index_length"];
            }

            //B a kB
            $sizeKB = $sizebd / 1024;
        }
        echo "$sizeKB KiB";

        mysqli_close($connection);

    }



//--------------------    CONTROLA LOS USUARIOS    --------------------

    /**
     * ajax que actualiza el numero de usuario
     */
    public function numero_usuarios()
    {
        // Usuario nombre del modelo Usuario()

        $usuario = Usuario::all();
        $numeroUser = count($usuario);

        //$cadena = "El numero de usuarios es: ".$numeroUser." <br>";

        echo $numeroUser;
    }

    /**
     *
     */
    public function procesar_registro()
    {
        if (isset($_POST["nombre"], $_POST["fechaNacim"], $_POST["email"], $_POST["contra1"], $_POST["contra2"],$_POST["estado"])) {

            $nombre = $_POST["nombre"];
            $fechaNacim = $_POST["fechaNacim"];
            $email = $_POST["email"];
            $contra1 = $_POST["contra1"];
            $contra2 = $_POST["contra2"];
            $estado = $_POST["estado"];


            if ($contra1 == $contra2) {
                //si existe el email registrado envia aviso e imposibilita el resgistro
                if (Usuario::where('email', $email)->exists()) {
                    return view('register', ['emailExistente' => true]);
                    } else {

                    if (Usuario::where('nombre', $nombre)->exists()) {
                        return view('register', ['usernameExistente' => true]);
                    } else {
                        //insertar en BD usando clase Eloquent
                        $datos = array();
                        $datos[0] = $nombre;
                        $datos[1] = $fechaNacim;
                        $datos[2] = $email;
                        $datos[3] = md5($contra1);
                        $datos[4] = md5($contra2);
                        $datos[5] = date("Y-m-d H:i:s");
                        $datos[6] = $estado;
                        //


                        $usuario = new Usuario(); //nombre del modelo Usuario() que hace referencia a la tabla user
                        $usuario->nombre = $datos[0];
                        $usuario->email = $datos[2];
                        $usuario->passwd = $datos[3];
                        $usuario->fechaNacimiento = $datos[1];
                        $usuario->fecha = $datos[5];
                        $usuario->estado = $datos[6];
                        //

                        $usuario->save();
                    }
                }
            } else {
                return view('register', ['contraseñaIncorrecta' => true]);
            }
        }
        $usuario = Usuario::where('nombre', $datos[0])->get();
        //creamos 2 sesiones user y nombre. con el id y con el nombre del usuario.
        session(['user' => $usuario[0]['id']]);
        session(['nombre' => $usuario[0]['nombre']]);
        return redirect()->to("/misCanales");
    }

    /**
     *
     */
    public function procesar_login()
    {
        if (isset($_POST["nombre"], $_POST["contra1"])) {

            $nombre = $_POST["nombre"];
            $contra1 = md5($_POST["contra1"]);

            $datos = array();
            $datos[0] = $nombre;
            $datos[1] = $contra1;

            if (Usuario::where('nombre', $datos[0])->exists()) {

                $usuario = Usuario::where('nombre', $datos[0])->get();

                if ($usuario[0]['passwd'] == $datos[1]) {
                    //creamos 2 sesiones user y nombre. con el id y con el nombre del usuario.
                    session(['user' => $usuario[0]['id']]);
                    session(['nombre' => $usuario[0]['nombre']]);

                    return redirect()->to("/misCanales");

                } else {
                    return view('login', ['contraseñaIncorrecta' => true]);
                }

            } else {
                return view('login', ['usuarioInexistente' => true]);
            }
        }
    }

    /**
     * cierre de sesión del usuario
     */
    public function cerrar_session()
    {
        session()->forget(['user', 'nombre']);  //elimina las sesiones
        session()->flush();                     //elimina todos los datos de la sesion
        return view('index');
    }


//--------------------    CONTROLA LOS CANALES    --------------------

    /**
     * recepcion del form de canales e insercion en la BBDD
     */
    public function procesar_canal()
    {
        if (isset($_POST["nombreCanal"], $_POST["descripcion"], $_POST["longitud"], $_POST["latitud"], $_POST["nombresensor"])) {

            $nombreCanal = $_POST["nombreCanal"];
            $descripcion = $_POST["descripcion"];
            $longitud = $_POST["longitud"];
            $latitud = $_POST["latitud"];
            $nombreSensor = $_POST["nombresensor"];

            if (Canal::where('nombreCanal', $nombreCanal)->exists()){
                return view('crearCanal', ['canalExistente' => true]);
            }else{

            $idUsuario = session("user"); //la sesion tiene almacenada el id del usuario

            //insertar en BD usando clase Eloquent
            $datos = array();

            $datos[6] = $idUsuario;
            $datos[0] = $nombreCanal;
            $datos[1] = $descripcion;
            $datos[2] = $longitud;
            $datos[3] = $latitud;
            $datos[4] = $nombreSensor;
            $datos[5] = date("Y-m-d H:i:s");

            $canal = new Canal(); //nombre del modelo Canal() que hace referencia a la tabla canales

            $canal->nombreCanal = $datos[0];
            $canal->descripcion = $datos[1];
            $canal->longitud = $datos[2];
            $canal->latitud = $datos[3];
            $canal->nombreSensor = $datos[4];
            $canal->fecha = $datos[5];
            $canal->id_user = $datos[6];

            $canal->save();
             }
        }
        return redirect()->to("/misCanales");
    }


    /**
     * ajax que actualiza el numero de canales totales creados
     */
    public function numero_canales()
    {
        $canal = Canal::all(); // Canal nombre del modelo Canal()
        $numeroCanal = count($canal);
        echo $numeroCanal;
    }

    /**
     * Obtiene todos los canales creados y los envia a la vista canales
     */
    public function listaCanales()
    {
        $canales = Canal::get();
        $usuarios = Usuario::get();

        return view('canales')
            ->with('canales', $canales) //pasar todos los canales como variable $canales
            ->with('usuarios', $usuarios);
    }

    /**
     * obtiene la sesion del usuario y presenta sus canales en la vista misCanales cuando la sesión este iniciada
     */
    public function listaMisCanales()
    {
        $id_user = session("user");
        $canales = Canal::where('id_user', $id_user)->get();

        return view('misCanales')
            ->with('canales', $canales);
    }

    /**
     * elimina el canal que se le pasa por parametro
     * @param $id del canal a eliminar
     */
    public function eliminarCanal($id)
    {
        Canal::destroy($id);
        return redirect()->to('misCanales');
    }


    /**
     * Obtiene los 2 últimos canales creados
     */
    public function ultimosCanales()
    {
        $ultimosCanales = Canal::orderBy('created_at', 'desc')
            ->take(2)
            ->get();
        return $ultimosCanales;
    }


// --------------------    CONTROLA LOS SENSORES   / --------------------

    /**
     * ajax que actualiza el numero de usuario
     */
    public function numero_sensores()
    {
        $sensores = count(Sensor::all());
        return $sensores;
    }

    /**
     * @param $idCanal del cual queremos obtener los datos de sensor
     */
    public function getJSON($idCanal)
    {

        // Datos para la gráfica
        $datosSensor = Sensor::select('created_at', 'dato')
            ->where('id_canal', $idCanal)
            ->get();

        //Ajustar tiempo
        for ($i = 0; $i < count($datosSensor); $i++) {
            $time = $datosSensor[$i]["created_at"];
            $datosSensor[$i]["created_at"] = strtotime($time);
        }

        //Quitar el array asociativo
        $data = array();
        $i = 0;
        foreach ($datosSensor as $fila) {
            $data[$i][0] = date("Y-m-d H:i:s", strtotime($datosSensor[$i]["created_at"]));
            $data[$i][1] = floatval($fila['dato']);
            $i++;
        }

        header('Content-type: application/json');
        echo json_encode($data);
    }

    /**
     * @param $id
     *  obtiene el sensor y el canal gracias al id del canal y lo envia a la vista mis canales
     */
    public function graficaCanal($id)
    {
        $sensores = Sensor::where('id_canal', $id)->get();
        $canales = Canal::where('id', $id)->get();

        return view('misCanales')
            ->with('sensor', $sensores)
            ->with('canal', $canales);
    }


    /**
     * @param $id  del sensor
     * @param $desde fecha de comienzo
     * @param $hasta fecha de final
     * @return datos forma json del sensor
     */
    public function servicioWebFechas($id, $desde, $hasta)
    {
            $datos = Sensor::where('id', $id)->whereBetween('fecha', array($desde, $hasta))->get();
            header('Content-type: application/json');
            return json_encode($datos);
    }

}
