<?php

namespace App\Http\Controllers;

use App\Amigos;
use App\Mensajes;
use App\Usuario;
use App\Canal;

use Illuminate\Http\Request;

class SocialController extends Controller
{
    //PERFIL
    public function socialPerfil()
    {
        return view("socialPerfil");
    }

    public function procesar_estado_editado()
    {

        if (isset($_POST['idUsuario'])) {
            $usuario = Usuario::where('id', $_POST['idUsuario'])
                ->first();

            if ($_POST['estado'] != "") {
                $usuario->estado = $_POST['estado'];
            }

            $usuario->save();
            return redirect('/social')->with('exito', 'Se ha editado el estado ' . $usuario->estado . ' correctamente');
        }
    }

    public function procesar_imagen_editado()
    {
        if (isset($_FILES['image']['name'])){

            // Eliminamos el antiguo
            if(file_exists("perfiles/".session('nombre').".jpg")){
                unlink(public_path("perfiles/".session('nombre').".jpg"));
            }

            $saveto = "perfiles/".session('nombre').".jpg";
            move_uploaded_file($_FILES['image']['tmp_name'], $saveto);
            $typeok = TRUE;

            switch($_FILES['image']['type'])
            {
                case "image/gif":   $src = imagecreatefromgif($saveto); break;
                case "image/jpeg":  // Both regular and progressive jpegs
                case "image/pjpeg": $src = imagecreatefromjpeg($saveto); break;
                case "image/png":   $src = imagecreatefrompng($saveto); break;
                default:            $typeok = FALSE; break;
            }

            if ($typeok)
            {
                list($w, $h) = getimagesize($saveto);

                $max = 100;
                $tw  = $w;
                $th  = $h;

                if ($w > $h && $max < $w)
                {
                    $th = $max / $w * $h;
                    $tw = $max;
                }
                elseif ($h > $w && $max < $h)
                {
                    $tw = $max / $h * $w;
                    $th = $max;
                }
                elseif ($max < $w)
                {
                    $tw = $th = $max;
                }

                $tmp = imagecreatetruecolor($tw, $th);
                imagecopyresampled($tmp, $src, 0, 0, 0, 0, $tw, $th, $w, $h);
                imageconvolution($tmp, array(array(-1, -1, -1),
                    array(-1, 16, -1), array(-1, -1, -1)), 8, 0);
                imagejpeg($tmp, $saveto);
                imagedestroy($tmp);
                imagedestroy($src);
            }
        }
        return redirect('/social')->with('exito', 'Se ha editado la imagen de perfil correctamente');    }

    //CANALES
    public function socialCanales()
    {
        return view("socialCanales");
    }

    public function canales()
    {
        $id_user = session("user");
        $canales = Canal::where('id_user', $id_user)->get();

        return view('socialCanales')->with('canales', $canales);
    }

    public function listaCanales()
    {
        $canales = Canal::get();
        $usuarios = Usuario::get();
        $amigos = Amigos::get();


        return view('socialCanales')
            ->with('canales', $canales)
            ->with('usuarios', $usuarios)
            ->with('amigos', $amigos);
    }

    //AMIGOS
    public function socialAmigos()
    {
        return view("socialAmigos");
    }

    public function amigos()
    {
        $usuarios = Usuario::get();
        $amigos = Amigos::get();

        return view('socialAmigos')->with('amigos', $amigos)->with('usuarios', $usuarios);
    }


    //MENSAJES
    public function socialMensajes()
    {
        return view("socialMensajes");
    }

    public function usuarios()
    {
        $usuarios = Usuario::get();
        $amigos = Amigos::get();

        return view('socialMensajes')->with('usuarios', $usuarios)->with('amigos', $amigos);
    }


    public function procesar_mensaje_usuario()
    {

        if (isset($_POST['idEmisor'], $_POST['pm'], $_POST['mensaje'], $_POST['idDestinatario'])) {

            $mensaje = new Mensajes();

            $mensaje->id_emisor = $_POST['idEmisor'];
            $mensaje->id_receptor = $_POST['idDestinatario'];
            $mensaje->pm = $_POST['pm'];
            $mensaje->mensaje = $_POST['mensaje'];
            $mensaje->save();


            return redirect()->to('social/socialMensajes');
        }
    }


    public function procesar_mensaje_muro()
    {

        if (isset($_POST['idEmisor'], $_POST['mensaje'], $_POST['idEmisor'])) {

            $mensaje = new Mensajes();

            $mensaje->id_emisor = $_POST['idEmisor'];
            $mensaje->id_receptor = $_POST['idEmisor'];
            $mensaje->pm = 0;
            $mensaje->mensaje = $_POST['mensaje'];
            $mensaje->save();


            return redirect()->to('/social');
        }
    }

    public function listaMensajes()
    {
        $mensajes = Mensajes::get();
        $usuarios = Usuario::get();
        $amigos = Amigos::get();


        return view('socialMensajes')
            ->with('mensajes', $mensajes)
            ->with('usuarios', $usuarios)
            ->with('amigos', $amigos);
    }

    public function mensajes_muro()
    {
        $mensajes = Mensajes::whereColumn('id_emisor', 'id_receptor')->orderBy('created_at', 'desc')->take(5)->get();

        foreach ($mensajes as $mensaje) {
            $usuario = Usuario::where('id', $mensaje->id_emisor)->first();
            $nombre = $usuario->nombre;
            $texto = $mensaje->mensaje;
            $fecha = $mensaje->created_at;
            $fechaComoEntero = strtotime($fecha);
            $dia = date("Y-m-d", $fechaComoEntero);
            $tiempo = date("H:i:s", $fechaComoEntero);

            echo "<article style='display: block; size: 20px; margin-left: 33%;'>" ."<p style='display: inline-block; font-weight: bold'>". $nombre.":</p> " . $texto . ". <p style='display:inline-block; font-style: italic';>Enviado el " . $dia . " a las " . $tiempo . " </p></article>";

        }
    }


    //MIEMBROS
    public function socialMiembros()
    {
        return view("socialMiembros");
    }

    public function miembros()
    {
        $usuarios = Usuario::get();
        $amigos = Amigos::get();

        return view('socialMiembros')->with('usuarios', $usuarios)->with('amigos', $amigos);
    }

    public function follow($id)
    {
        $amigo = new Amigos();

        $amigo->id_user = session('user');
        $amigo->id_follower = $id;
        $amigo->save();

        return redirect('social/socialMiembros');
    }

    public function unfollow($id)
    {
        $id_user = session('user');
        Amigos::where('id_user', '=', $id_user)->where('id_follower', '=', $id)->delete();

        return redirect('social/socialMiembros');
    }


    public static function comprobarSiTeSigo($id)
    {

        if (Amigos::where('id_user', '=', session('user'))->where('id_follower', '=', $id)->exists()) {
            return true;
        } else {
            return false;
        }

    }


    public static function meSiguen($id)
    {

        if (Amigos::where('id_user', '=', $id)->where('id_follower', '=', session('user'))->exists()) {

            return true;

        } else {
            return false;
        }

    }


}
