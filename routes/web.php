<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

//RUTAS SIN NECESIDAD DE CONTROLLER
Route::get('/', function () {
    return view('index');
});
Route::get("/ayuda", function (){
    return view("ayuda");});

Route::get("/contacto", function (){
    return view("contacto");});

//RUTAS AJAX (situadas en index)
Route::get("/numero_usuarios", "UserController@numero_usuarios");
Route::get("/numero_canales", "UserController@numero_canales");
Route::get("/numero_sensores", "UserController@numero_sensores");
Route::get("/capacidad_datos", "UserController@capacidad_datos");


//RUTAS REDIRECCIONAMIENTO
Route::get("/login","UserController@login");
Route::get("/register","UserController@register");
Route::get("/crearCanal","UserController@crearCanal");
Route::get("/canales","UserController@canales");
Route::get("/misCanales","UserController@misCanales");

//RUTAS RELACIONADAS USER
Route::post("/procesar_registro","UserController@procesar_registro");
Route::post("/procesar_login","UserController@procesar_login");
Route::get("/cerrar_session","UserController@cerrar_session");

//RUTAS RELACIONADAS CANAL
Route::post("/procesar_canal","UserController@procesar_canal");
Route::get('/canales', 'UserController@listaCanales');
Route::get('/misCanales', 'UserController@listaMisCanales');
Route::get('/misCanales/{id}', 'UserController@eliminarCanal');
Route::get('/ultimosCanales', 'UserController@ultimosCanales');


//RUTAS RELACIONADAS SENSOR
Route::get('/canalJSON/{id}','UserController@getJSON');
Route::get('/graficaCanal/{id}', function ($id) {
    return view('graficaCanal', ['id' => $id]);
});

//RUTAS RELACIONADAS SERVICIOWEB SENSOR
Route::get('/datosSWSensor', "UserController@datosSWSensor");
Route::get("/servicioWeb","UserController@servicioWeb");
Route::get('/servicioWebFechas/{id}/{desde}/{hasta}', 'UserController@servicioWebFechas');

//-------------------------------------------------- LABORATORIO 2 -----------------------------------------------------
//--------------------------------------------------     Shop      -----------------------------------------------------


//SHOP
Route::get("/shop", function (){
    return view("shop");});

//BACKEND SHOP
Route::get("/shopAdmin", "ShopController@listaProductos");
    //ORDENES
Route::get('/shopAdmin/ordenes', 'ShopController@listaOrdenes');
    //TRANSACCIONES
Route::get('/shopAdmin/transacciones', 'ShopController@listaTransacciones');

//PRODUCTO
Route::get('/shopAdmin/crearProducto', 'ShopController@crearProducto');
Route::post('/procesar_producto', 'ShopController@procesar_producto');

Route::get('/shopAdmin/actualizarProducto', 'ShopController@actualizarProducto');
Route::post('/procesar_producto_actualizado', 'ShopController@procesar_producto_actualizado');

Route::get('/shop/consultarProducto', 'ShopController@consultarProducto');
Route::get('/shopAdmin/consultarProducto', 'ShopController@consultarProducto');

Route::get('/shopAdmin/eliminarProducto', 'ShopController@eliminarProducto');

//CARRITO
Route::get('/shop/miCarrito', 'ShopController@miCarrito');
Route::post('/shop/addCarrito', 'ShopController@addCarrito');
Route::get('/eliminarProductoCarrito', 'ShopController@eliminarProductoCarrito');
Route::get('/shop/vaciarCarrito', 'ShopController@vaciarCarrito');
Route::get("/numero_carrito", "ShopController@numero_carrito");

Route::get('/shop/checkout', 'ShopController@verCheckout');

//PAYPAL
Route::get('/shop/pagoPaypal', 'paypalController@payWithPayPal');
Route::get('/paypal/status', 'paypalController@payPalStatus');



//--------------------------------------------------     Social    -----------------------------------------------------

//RED SOCIAL
Route::get("/social", function (){
    return view("social");});

Route::get('/social/socialAmigos', 'SocialController@socialAmigos');
Route::get('/social/socialCanales', 'SocialController@socialCanales');
Route::get('/social/socialMensajes', 'SocialController@socialMensajes');
Route::get('/social/socialMiembros', 'SocialController@socialMiembros');
Route::get('/social/socialPerfil', 'SocialController@socialPerfil');

//PERFIL
Route::post('/procesar_estado_editado', 'SocialController@procesar_estado_editado');
Route::post('/procesar_imagen_editado', 'SocialController@procesar_imagen_editado');


//AMIGOS
Route::get('/social/socialAmigos', 'SocialController@amigos');

//MIEMBROS
Route::get('/social/socialMiembros', 'SocialController@miembros');

Route::post('/unfollow/{id}', 'SocialController@unfollow');
Route::post('/follow/{id}', 'SocialController@follow');

//CANALES
Route::get('/social/socialCanales', 'SocialController@canales');
Route::get('/social/socialCanales', 'SocialController@listaCanales');

//MENSAJES
Route::get('/social/socialMensajes', 'SocialController@usuarios');
Route::post('/procesar_mensaje_usuario', 'SocialController@procesar_mensaje_usuario');
Route::post('/procesar_mensaje_muro', 'SocialController@procesar_mensaje_muro');
Route::get('/social/socialMensajes', 'SocialController@listaMensajes');     //dar forma a mnsjes

Route::get("/mensajes_muro", "SocialController@mensajes_muro");


