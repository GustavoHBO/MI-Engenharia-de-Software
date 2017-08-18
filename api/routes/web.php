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

$app->post('/login', 'LoginController@login');

$app->group(['prefix' => 'backup'], function () use ($app){
    $app->get('/', 'FileController@readAll');
    $app->post('/', 'FileController@delete');
});

$app->group(['prefix' => 'usuario'], function () use ($app){
    $app->get('/', 'UsuarioController@readAll');
    $app->get('/{id}', 'UsuarioController@read');
    $app->post('/new', 'UsuarioController@create');
	$app->post('/update', 'UsuarioController@update');
	$app->post('/desativar', 'UsuarioController@desativar');
});

/*
Grupo do dashboard da exposicao
*/

$app->group(['prefix' => 'funcionario'], function () use ($app){
    $app->get('/', 'FuncionarioController@readAll');
    $app->get('/{id}', 'FuncionarioController@read');
    $app->post('/new', 'FuncionarioController@create');
	$app->post('/update', 'FuncionarioController@update');
	$app->post('/desativar', 'FuncionarioController@desativar');
});


/*
Grupo da exposicao
*/
$app->group(['prefix' => 'exposicao'], function () use ($app){

    $app->get('/listar', 'ExposicaoController@listarExposicao');
    $app->get('/listartodos', 'ExposicaoController@listarExposicaoTodos');
	$app->get('/buscar/{key_word}', 'ExposicaoController@buscarExposicao');
	$app->get('/get/{id_exposicao}', 'ExposicaoController@buscarExposicao_id');
    $app->post('/cadastrar', 'ExposicaoController@cadastrarExposicao');
    $app->post('/atualizar', 'ExposicaoController@atualizarExposicao');
    $app->post('/excluir', 'ExposicaoController@excluirExposicao');

});

/*
	Dashboard para cadastro das noticias
	Estou passando os dados pelo metodo get
	para poder testar a insercoes, remocoes
	e etc no banco de dados

    Algumas rotas ainda precisa ser definida, como a
	as rotas de exibir e compartilhamento que estou em duvida

*/
$app->group(['prefix' => 'noticia'], function () use ($app){
    // mudei para ter apenas um modulo com tudo referente a noticia (facilita a interpretação das rotas visto que muitas serão usadas tanto pra func quanto pra usr comum)
    $app->get('/buscar/{key_word}', 'NoticiaController@buscarNoticia');
    $app->get('/get/{id}', 'NoticiaController@busca_Id_Noticia');
	$app->get('/listar', 'NoticiaController@listarNoticia');
    $app->post('/cadastrar', 'NoticiaController@cadastrarNoticia');
	$app->post('/excluir', 'NoticiaController@excluirNoticia');
	$app->post('/atualizar','NoticiaController@atualizarNoticia');
    $app->post('/atualizarImagem', 'NoticiaController@atualizar_imagem_noticia');

	$app->get('/', function(){
		return "Principal do DashBoard noticia";
	});
});



/*ITEM*/
$app->group(['prefix' => 'item'], function () use ($app) {
    //lista todos itens
    $app->get('/', 'ItemController@todosItens');
    //lista todos itens ativos
    $app->get('/ativos', 'ItemController@todosItensAtivos');
    //lista todos itens ativos por uma faixa de valores definida
    $app->get('/ativos/{faixa}', 'ItemController@todosItensAtivosPorFaixa');
    //buscar um item id
    $app->get('/{id}', 'ItemController@buscarItem');
    //pesquisar item
    $app->get('/pesquisar/{titulo}', 'ItemController@pesquisarItem');
    //cadastra item
    $app->post('/', 'ItemController@cadastroItem');
    //editar um item
    $app->post('/editar', 'ItemController@editarItem');
    //desativa item
    $app->post('/desativa', 'ItemController@desativaItem');
    //ativa item
    $app->post('/ativa', 'ItemController@ativaItem');
    //favorita item
    $app->post('/favoritos/add', 'ItemController@favoritaItem');
    //itens favoritos de um usuario
    $app->get('/favoritos/{id_usr}', 'ItemController@todosItensFavoritos');
    //remover item favorito
    $app->post('/favoritos/remover', 'ItemController@removerFavorito');

});

/*EVENTO*/
$app->group(['prefix' => 'evento'], function () use ($app) {
    //lista todos eventos
    $app->get('/', 'EventoController@todosEventos');
    //lista todos eventos ativos
    $app->get('/ativos', 'EventoController@todosEventosAtivos');
    //numero de itens ativos
    $app->get('/ativos/num', 'ItemController@numeroDeItensAtivos');
    //buscar evento pelo id
    $app->get('/{id}', 'EventoController@buscarEvento');
    //pesquisar evento pelo titulo
    $app->get('/pesquisar/{titulo}', 'EventoController@pesquisarEvento');
    //cadastra evento
    $app->post('/cadastrar', 'EventoController@cadastroEvento');
    //editar um evento
    $app->post('/editar', 'EventoController@editarEvento');
    //desativa evento
    $app->post('/desativa', 'EventoController@desativaEvento');
    //ativa evento
    $app->post('/ativa', 'EventoController@ativaEvento');
    //favorita evento
    $app->post('/favoritos/add', 'EventoController@favoritaEvento');
    //eventos favoritos de um usuario
    $app->get('/favoritos/{id_usr}', 'EventoController@todosEventosFavoritos');
    //remover evento favorito
    $app->post('/favoritos/remover', 'EventoController@removerFavorito');
});


$app->group(['prefix' => 'pesquisa'], function () use ($app) {
    $app->post('cadastro', 'PesquisaController@cadastro');
    // $app->get('gerenciamento', 'PesquisaController@cadastro');
    $app->post('editar/{idpesquisa}', 'PesquisaController@editar');
    $app->post('excluir/{idpesquisa}', 'PesquisaController@excluir');
    $app->get('listar', 'PesquisaController@getAll');
    $app->get('{idpesquisa}', 'PesquisaController@get');
    $app->get('/', 'PesquisaController@getall');
});

$app->group(['prefix' => 'relatorio'], function () use ($app) {
    $app->get('listar/{datainicial}/{datafinal}', 'RelatorioController@get');
});
