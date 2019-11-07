<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It is a breeze. Simply tell Lumen the URIs it should respond to
| and give it the Closure to call when that URI is requested.
|
*/

$router->group(["prefix" => "/agenda"], function () use($router){
	$router->post("/", "agendaController@agendar");
	$router->put("/", "agendaController@cancelar");
	$router->get("/{data}", "agendaController@listar");
});

/*$router->get('/', function () use ($router) {
    return $router->app->version();
});
*/