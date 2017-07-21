<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Http\Controllers\RelatorioController;

class ItemController extends Controller
{
    protected $controllerRelatorio;

    public function __construct(RelatorioController $relatorioController)
    {
        $this->relatorioController = $relatorioController;
    }
    /*RETORNA TODOS OS ITENS*/
    public function todosItens(){
        $busca = DB::SELECT('SELECT * FROM item');
        return response()->json($busca);
    }
    /*RETORNA TODOS OS ITENS ATIVOS*/
    public function todosItensAtivos(){
        $busca = DB::SELECT('SELECT * FROM item WHERE ativo = 1');
        return response()->json($busca);
    }
    /*BUSCAR ITEM PELO ID*/
    public function buscarItem($id){
        $busca = DB::SELECT('SELECT * FROM item WHERE id_item = ?',
        [$id]);
        if ($busca == null)
            return response()->json(false);
        
        $busca = $busca[0];
        return response()->json($busca);
    }
    /*PESQUISAR ITEM PELO TITULO*/
    public function pesquisarItem($titulo){
        $busca = DB::SELECT('SELECT * FROM item WHERE titulo LIKE  ?',
        ["%".$titulo."%"]);
        if ($busca == null)
            return response()->json(false);
        
        $busca = $busca;
        return response()->json($busca);
    }
    /*CADASTRO DE ITEM*/
    public function cadastroItem(Request $request){
        $dados = $request->all();
        
        //verifica se já não existe
        $busca = DB::SELECT('SELECT id_item FROM item WHERE id_item = ?',
        [$dados['id_item']]);

        if ($busca != null)
            return response()->json(false);

        $add_item = DB::INSERT('INSERT INTO item (id_item,material, doador, funcao, procedencia, autor, origem, conservacao, colecao, categoria, classificacao, titulo,imagem_3d, estado_de_conservacao, iconologia, referencias_bibliograficas, descricao_objeto, local, data, historico, ativo) VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)',
        [$dados['id_item'],$dados['material'],$dados['doador'], $dados['funcao'], $dados['procedencia'], $dados['autor'], $dados['origem'], $dados['conservacao'], $dados['colecao'], $dados['categoria'], $dados['classificacao'],$dados['titulo'],$dados['imagem_3d'], $dados['estado_de_conservacao'], $dados['iconologia'],$dados['referencias_bibliograficas'],$dados['descricao_objeto'],$dados['local'],$dados['data'], $dados['historico'], 1]);

        $add_aquisicao = DB::INSERT('INSERT INTO aquisicao_item (Item_id_item, data, modo_aquisicao, autor, observacao) VALUES (?,?,?,?,?)',
        [$dados['id_item'],$dados['data_aq'],$dados['modo_aquisicao'], $dados['autor'], $dados['observacao']]);

        $add_carac_estilisticas = DB::INSERT('INSERT INTO caracteristicas_estilisticas_item (Item_id_item, materiais_constitutivos, tecnica_fabricacao, autoria) VALUES (?,?,?,?)',
        [$dados['id_item'],$dados['materiais_constitutivos'],$dados['tecnica_fabricacao'], $dados['autoria']]);

        $add_dimensao = DB::INSERT('INSERT INTO dimensao_item (Item_id_item, altura, diamentro, largura, peso, comprimento) VALUES (?,?,?,?,?,?)',
        [$dados['id_item'],$dados['altura'],$dados['diametro'],$dados['largura'], $dados['peso'], $dados['comprimento']]);

        $add_doc_fotografica = DB::INSERT('INSERT INTO documentacao_fotografica_item (Item_id_item, fotografo, data, foto_url) VALUES (?,?,?,?)',
        [$dados['id_item'],$dados['fotografo'],$dados['data_foto'], $dados['doc_foto_url']]);

        $add_imagem = DB::INSERT('INSERT INTO item_imagem (Item_id_item, foto_url) VALUES (?,?)',
        [$dados['id_item'],$dados['foto_url']]);


        if  ($add_item && $add_aquisicao&&$add_carac_estilisticas&&$add_dimensao&&$add_doc_fotografica&&$add_imagem){
            //$relatorioController->criarItem($dados['id_item'],$dados['id_usr']);
            return response()->json(true);
        } else {
            return response()->json(false);
        }
    }
    /*Função para editar item*/
    public function editarItem (Request $request){
        $dados = $request->all();

        $update_item = DB::UPDATE('UPDATE item SET material = ?, doador = ?, funcao = ?, procedencia = ?, autor = ?, origem = ?, conservacao = ?, colecao = ?, categoria = ?, classificacao = ?, titulo = ?,imagem_3d =?, estado_de_conservacao = ?, iconologia = ?, referencias_bibliograficas = ?, descricao_objeto = ?, local = ?, data = ?, historico = ? WHERE id_item = ?',
        [$dados['material'],$dados['doador'], $dados['funcao'], $dados['procedencia'], $dados['autor'], $dados['origem'], $dados['conservacao'], $dados['colecao'], $dados['categoria'], $dados['classificacao'],$dados['titulo'],$dados['imagem_3d'], $dados['estado_de_conservacao'], $dados['iconologia'],$dados['referencias_bibliograficas'],$dados['descricao_objeto'],$dados['local'],$dados['data'], $dados['historico'], $dados['id_item']]);

        $update_aquisicao = DB::UPDATE('UPDATE aquisicao_item SET data = ?, modo_aquisicao = ?, autor = ?, observacao = ? WHERE Item_id_item = ?',
        [$dados['data'],$dados['modo_aquisicao'],$dados['autor'],$dados['observacao'],$dados['id_item']]);

        $update_carac_estilisticas = DB::UPDATE('UPDATE caracteristicas_estilisticas_item SET materiais_constitutivos = ?, tecnica_fabricacao = ?, autoria = ? WHERE Item_id_item = ?',
        [$dados['materiais_constitutivos'],$dados['tecnica_fabricacao'],$dados['autoria'],$dados['id_item']]);

        $update_dimensao = DB::UPDATE('UPDATE dimensao_item SET altura = ?, diamentro = ?, largura = ?, peso = ?, comprimento = ? WHERE Item_id_item = ?',
        [$dados['altura'],$dados['diamentro'],$dados['largura'], $dados['peso'], $dados['comprimento'],$dados['id_item']]);

        $update_doc_fotografica = DB::UPDATE('UPDATE documentacao_fotografica_item SET fotografo = ?, data = ?, foto_url = ? WHERE Item_id_item = ?',
        [$dados['fotografo'],$dados['data'],$dados['foto_url'],$dados['id_item']]);

        $update_imagem = DB::UPDATE('UPDATE item_imagem SET foto_url = ? WHERE Item_id_item = ?',
        [$dados['foto_url'],$dados['id_item']]);


        if  ($update_item || $update_aquisicao || $update_carac_estilisticas || $update_dimensao || $update_doc_fotografica || $update_imagem){
            //$relatorioController->editaItem($dados['id_item'],$dados['id_usr']);
            return response()->json(true);
        } else {
            return response()->json(false);
        }

    }
    /*DESATIVA ITEM*/
    public function desativaItem (Request $request){
        $dados = $request->all();

        $desativa = DB::UPDATE('UPDATE item SET ativo = 0 WHERE id_item = ?',[$dados['id_item']]);

        if  ($desativa){
            return response()->json(true);
        } else {
            return response()->json(false);
        }
    }

    /*ATIVA ITEM*/
    public function ativaItem (Request $request){
        $dados = $request->all();

        $ativa = DB::UPDATE('UPDATE item SET ativo = 1 WHERE id_item = ?',[$dados['id_item']]);

        if  ($ativa){
            return response()->json(true);
        } else {
            return response()->json(false);
        }
    }
    /*FAVORITA ITEM*/
    public function favoritaItem(Request $request){
        $dados = $request->all();

        $busca = DB::SELECT('SELECT favorita_item.Item_id_item, favorita_item.Usuario_id_usuario FROM favorita_item WHERE favorita_item.Item_id_item = ? AND favorita_item.Usuario_id_usuario = ?',
        [$dados['Item_id_item'],$dados['Usuario_id_usuario']]);

        if ($busca != null)
            return response()->json(false);

        $add = DB::INSERT('INSERT INTO favorita_item (Item_id_item, Usuario_id_usuario) VALUES (?, ?)',
        [$dados['Item_id_item'], $dados['Usuario_id_usuario']]);

        if  ($add){
            return response()->json(true);
        } else {
            return response()->json(false);
        }
    }

    public function todosItensFavoritos($id_usr){
        //FALTA COLOCAR O RETORNO CERTO
        $busca = DB::SELECT('SELECT it.titulo, it.autor FROM favorita_item fi INNER JOIN item it ON fi.Item_id_item = it.id_item INNER JOIN usuario usr ON usr.id_usuario = ?',[$id_usr]);
        
        if ($busca == null)
            return response()->json(false);
        
        return response()->json($busca);
    }
    /*REMOVE FAVORITO*/
    public function removerFavorito (Request $request){
        $dados = $request->all();

        $delete = DB::DELETE('DELETE FROM favorita_item WHERE favorita_item.Item_id_item = ? AND favorita_item.Usuario_id_usuario = ?', [$dados['id_item'],$dados['id_usr']]);

        if  ($delete){
            return response()->json(true);
        } else {
            return response()->json(false);
        }

    }

  
    

    

}
