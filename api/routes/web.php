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


$app->group(['prefix' => 'item'], function () use ($app) {
    $app->get('cadastrar', function ()    {
        return 'cadastro de item';
    });
    $app->get('gerenciamento', function ()    {
        return 'gerenciamento de item';
    });
    $app->get('editar/{iditem}', function ($iditem)    {
        return 'edicao de item '. $iditem;
    });
    $app->get('listar', function ()    {
        return 'listagem de todos os itens';
    });
    $app->get('listar/favoritos', function ()    {
        return 'listagem de itens favoritos';
    });
    $app->get('visualizar/{iditem}', function ($iditem)    {
        return 'visualização de item '. $iditem;
    });
    $app->get('/', function ()    {
        return 'tela item';
    });
});

$app->group(['prefix' => 'evento'], function () use ($app) {
    $app->get('cadastro', function ()    {
        return 'cadastro evento';
    });
    $app->get('gerenciamento', function ()    {
        return 'gerenciamento evento';
    });
    $app->get('editar/{idevento}', function ($idevento)    {
        return 'editar evento ' .$idevento;
    });
    $app->get('excluir/{idevento}', function ($idevento)    {
        return 'excluir evento ' .$idevento;
    });
    $app->get('{idevento}', function ($idevento)    {
        return 'evento ' .$idevento;
    });
    $app->get('/', function ()    {
        return 'eventos';
    });
});