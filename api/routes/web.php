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

/*
Grupo para a parte das noticias
*/
$app->group(['prefix' => 'noticia'], function () use ($app){ 
	$app->post('/buscar/{id_buscar}', function (){
		return "Noticia Buscada";
	});

	$app->get('/exibir/{idexibir_noticia}', function ($idexibir_noticia){
		return "exibindo noticia " .$idexibir_noticia;
	});

	$app->get('/compartilhar/{idcompartilhar_noticia}', function ($idcompartilhar_noticia){
		return "compartilhando noticia " .$idcompartilhar_noticia;
	});

	$app->get('/', function(){
		return "Principal da Noticia";


	});

});

/*
Grupo de rotas para o dashboard da noticia
*/
$app->group(['prefix' => 'dashboard/noticia'], function () use ($app){ 
	$app->post('/cadastro', function (){
		return "cadastro da notícia";
	});

	$app->get('/listar', function (){
		return "cadastro da notícia";
	});

	$app->get('/excluir/{id_noticia_excluir}', function ($id_noticia_excluir){
		return "cadastro da notícia " .$id_noticia_excluir;
	});

	$app->get('/', function(){
		return "Principal do DashBoard notícia";


	});

});