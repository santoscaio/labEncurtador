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

/**
 * Welcome message
 *
 *
 * @return Response
 */
$app->get('/', function () use ($app) {
	echo 'Encurtador de URL' . '<br>';
	echo 'Autor: Caio Santos' . '<br>';
	echo 'Email: santoscaio@gmail.com' . '<br>';
});

$app->get('urls/{urlId}', 'UrlController@url'); //
$app->delete('urls/{urlId}', 'UrlController@delUrl'); //

$app->post('users/{userId}/urls', 'UserController@addUrlUser'); //
$app->post('users', 'UserController@addUser'); //
$app->delete('users/{userId}', 'UserController@delUser'); //
$app->get('users/{userId}/stats', 'UserController@stats'); //

$app->get('stats', 'StatsController@stats'); //
$app->get('stats/{urlId}', 'StatsController@urlStats'); //

$app->get('/{urlId}', 'UrlController@url'); //