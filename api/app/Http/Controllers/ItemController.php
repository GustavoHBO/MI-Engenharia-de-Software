<?php

namespace App\Http\Controllers;

class ItemController extends Controller
{

    public function __construct()
    {
        //
    }
    public function indexItem()
    {
        return 'index';
    }
    /*ITEM*/
    
    /*Cadastro item*/
    public function cadastroItem($material, $doador, $autor, $origem, $conservacao, $dimensoes, $colecao, $categoria, $classificacao, $titulo, $descricao, $imagem, $imagem3D)
    {
        $inserir = DB::INSERT('INSERT INTO item(material, doador, autor, origem, conservacao, dimensoes, colecao, categoria, classificacao, titulo, descricao, imagem, imagem3D) VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?)', 
                [$material, $doador, $autor, $origem, $conservacao, $dimensoes, $colecao, $categoria, $classificacao, $titulo, $descricao, $imagem, $imagem3D]);
        
        if($inserir){
            return response()->json(true);
        }else{
            return response()->json(false);
        }
    }
    /*Gerenciamento item*/
    public function gerenciamentoItem()
    {
        return 'gerenciamento';
    }
    /*Editar item*/
    public function editarItem($iditem,$material, $doador, $autor, $origem, $conservacao, $dimensoes, $colecao, $categoria, $classificacao, $titulo, $descricao, $imagem, $imagem3D)
    {
        $editado = DB::UPDATE('UPDATE item SET material = ?, doador = ?, autor = ?, origem = ?, conservacao = ?, dimensoes = ?, colecao = ?, categoria = ?, classificacao = ?, titulo = ?, descricao = ?, imagem = ?, imagem3D = ? WHERE iditem = ?', [$material, $doador, $autor, $origem, $conservacao, $dimensoes, $colecao, $categoria, $classificacao, $titulo, $descricao, $imagem, $imagem3D, $iditem]);

        if ($editado) {
            return response()->json(true);
        } else {
            return response()->json(false);
        }
    }
    /*Listar item*/
    public function listarItem()
    {
        $informacoes = DB::SELECT('SELECT * FROM item');
        return response()->json($informacoes);
    }
    /*public function listarFavoritosItem()
    {
        return 'listar favoritos';
    }*/
    /*Visualizar item*/
    public function visualizarItem($iditem)
    {
        /*$informacao = DB::SELECT('SELECT * FROM item WHERE iditem = ?',[$iditem]);
        return response()->json($informacoes);*/
        return 'visualizar'.$iditem;
    }
   
}
