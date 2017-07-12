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

$app->group(['prefix' => 'usr'], function () use ($app){
    $app->get('/', 'UsuarioController@readAll');
    $app->post('/new', 'UsuarioController@create');
	$app->post('/update', 'UsuarioController@update');
	$app->post('/desativar', 'UsuarioController@desativar');
});

/*
Grupo do dashboard da exposicao
*/

$app->group(['prefix' => 'usr'], function () use ($app){
    $app->get('/', 'FuncionarioController@readAll');
    $app->post('/new', 'FuncionarioController@create');
	$app->post('/update', 'FuncionarioController@update');
	$app->post('/desativar', 'FuncionarioController@desativar');
});

$app->group(['prefix' => 'dashboard/exposicao'], function () use ($app){
	$app->get('/', function (){
    	return 'dashboard da exposicao';
	});

	$app->post('/cadastrar', function (){
    	return 'Cadastro de um nova exposicao';
	});

	$app->post('/listar', function (){
    	return 'Cadastro de um nova exposicao';
	});

	$app->get('/editar/{idexposicao}', function ($idexposicao){
    	return 'editar exposicao' . $idexposicao;
	});

	$app->get('/excluir/{idexposicao}', function ($idexposicao){
    	return 'exposicao excluir ' . $idexposicao;
	});

});

/*
Grupo da exposicao
*/

$app->group(['prefix' => 'exposicao'], function () use ($app){

	$app->get('/', function (){
    return 'pagina principal da exposicao';
	});

	$app->get('/buscar/{idexposicao}', function ($idexposicao){
    return 'exposicao buscada: ' . $idexposicao;
	});

});

/*
	Acesso a funcoes das noticias pelo usuario.
	Algumas rotas ainda precisa ser definida, como a
	as rotas de exibir e compartilhamento que estou em duvida
*/
$app->group(['prefix' => 'noticia'], function () use ($app){

	$app->get('/buscar/{key_word}', 'NoticiaController@buscarNoticia');

	$app->get('/exibir/{idexibir_noticia}', function ($idexibir_noticia){
		return "exibindo noticia " .$idexibir_noticia;
	});

	$app->get('/compartilhar/{idcompartilhar_noticia}', function ($idcompartilhar_noticia){
		return "compartilhando noticia " .$idcompartilhar_noticia;
	});

	$app->get('/', function(){
		return "Principal da Noticia"; });
});


/*
	Dashboard para cadastro das noticias
	Estou passando os dados pelo metodo get
	para poder testar a insercoes, remocoes
	e etc no banco de dados
*/
$app->group(['prefix' => 'dashboard/noticia'], function () use ($app){

	$app->get('/cadastro/{titulo_noticia}/{descricao_noticia}/{data_publicacao}/{ativo_noticia}/{Usuario_id_user}', 'NoticiaController@cadastrarNoticia');
	$app->get('/listar', 'NoticiaController@listarNoticia');
	$app->get('/excluir/{id_noticia}', 'NoticiaController@excluirNoticia');
	$app->get('/atualizar/{id_noticia}/{titulo_noticia}/{descricao_noticia}/{data_publicacao}/{ativo_noticia}/{Usuario_id_user}','NoticiaController@atualizarNoticia');

	$app->get('/', function(){
		return "Principal do DashBoard noticia";
	});
});



$app->group(['prefix' => 'item'], function () use ($app) {
    $app->get('/', 'ItemController@index');
    
    $app->get('cadastrar', 'ItemController@cadastro');
    
    $app->get('gerenciamento', 'ItemController@gerenciamento');
    
    $app->get('editar/{iditem}', 'ItemController@editar');
    
    $app->get('listar', 'ItemController@listar');
    
    $app->get('listar/favoritos', 'ItemController@listarFavoritos');
    
    $app->get('visualizar/{iditem}', 'ItemController@visualizar');
    
    
});

$app->group(['prefix' => 'evento'], function () use ($app) {
    $app->get('/', 'EventoController@index');
    
    $app->get('cadastrar', 'EventoController@cadastro');
    
    $app->get('gerenciamento', 'EventoController@gerenciamento');
    
    $app->get('editar/{idevento}', 'EventoController@editar');
    
    $app->get('excluir/{idevento}', 'EventoController@excluir');
    
    $app->get('visualizar/{idevento}', 'EventoController@visualizar');
    
});

$app->group(['prefix' => 'pesquisa'], function () use ($app) {
    $app->post('cadastro', 'PesquisaController@cadastro');
    // $app->get('gerenciamento', 'PesquisaController@cadastro');
    $app->post('editar/{idpesquisa}', 'PesquisaController@editar');
    $app->post('excluir/{idpesquisa}', 'PesquisaController@excluir');
    $app->get('{idpesquisa}', 'PesquisaController@get'});
    $app->get('/', 'PesquisaController@getall');
});

$app->group(['prefix' => 'relatorio'], function () use ($app) {
    $app->post('cadastro', 'RelatorioController@novo');
    $app->get('{datainicial}/{datafinal}', 'RelatorioController@get');
});
