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

$app->get('/', function () use ($app) {
    return $app->version();
});

$app->get('/dashboard/exposicao', function (){
    return 'exposicao';
});

$app->post('/dashboard/exposicao/nova', function (){
    return 'exposicao nova';
});

$app->get('/dashboard/exposicao/editar/{idexposicao}', function ($idexposicao){
    return 'exposicao excluir ' . $idexposicao;
});

$app->get('/dashboard/exposicao/excluir/{idexposicao}', function ($idexposicao){
    return 'exposicao excluir ' . $idexposicao;
});

$app->get('/exposicoes', function (){
    return 'exposicoes';
});

$app->get('/exposicao/{idexposicao}', function ($idexposicao){
    return 'exposicao ' . $idexposicao;
});

$app->get('/noticia', function ($idnoticia){
	return 'exposicao' .$idnoticia;
});
