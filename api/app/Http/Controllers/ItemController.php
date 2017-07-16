<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class ItemController extends Controller
{
    //falta terminar de colocar o retorno certo
    public function todosItens(){
        $busca = DB::SELECT('SELECT titulo, autor FROM item');
        return response()->json($busca);
    }
    //falta terminar de colocar o retorno certo
    public function buscarItem($id){
        $busca = DB::SELECT('SELECT titulo FROM item WHERE id_item = ?',
        [$id]);
        if ($busca == null)
            return response()->json(false);
        
        $busca = $busca[0];
        return response()->json($busca);
    }

    public function cadastroItem(Request $request){
        $dados = $request->all();
        
        //verifica se já não existe
        // $busca = DB::SELECT('SELECT titulo FROM item WHERE titulo = ?',
        //[$dados['titulo']]);

        //if ($busca != null)
        //    return response()->json(false);
        $add = DB::INSERT('INSERT INTO item (material, doador, funcao, procedencia, autor, origem, conservacao, colecao, categoria, classificacao, titulo,imagem_3d, estado_de_conservacao, iconologia, referencias_bibliograficas, descricao_objeto, local, data, historico, ativo) VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)',
        [$dados['material'],$dados['doador'], $dados['funcao'], $dados['procedencia'], $dados['autor'], $dados['origem'], $dados['conservacao'], $dados['colecao'], $dados['categoria'], $dados['classificacao'],$dados['titulo'],$dados['imagem_3d'], $dados['estado_de_conservacao'], $dados['iconologia'],$dados['referencias_bibliograficas'],$dados['descricao_objeto'],$dados['local'],$dados['data'], $dados['historico'], $dados['ativo']]);

       
        if  ($add){
            return response()->json(true);
        } else {
            return response()->json(false);
        }
    }
    /*Função para editar item*/
    public function editarItem (Request $request){
        $dados = $request->all();

        $update = DB::UPDATE('UPDATE item SET material = ?, doador = ?, funcao = ?, procedencia = ?, autor = ?, origem = ?, conservacao = ?, colecao = ?, categoria = ?, classificacao = ?, titulo = ?,imagem_3d =?, estado_de_conservacao = ?, iconologia = ?, referencias_bibliograficas = ?, descricao_objeto = ?, local = ?, data = ?, historico = ?, ativo = ? WHERE id_item = ?',
        [$dados['material'],$dados['doador'], $dados['funcao'], $dados['procedencia'], $dados['autor'], $dados['origem'], $dados['conservacao'], $dados['colecao'], $dados['categoria'], $dados['classificacao'],$dados['titulo'],$dados['imagem_3d'], $dados['estado_de_conservacao'], $dados['iconologia'],$dados['referencias_bibliograficas'],$dados['descricao_objeto'],$dados['local'],$dados['data'], $dados['historico'], $dados['ativo'], $dados['id_item']]);

        if  ($update){
            return response()->json(true);
        } else {
            return response()->json(false);
        }

    }

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
        $busca = DB::SELECT('SELECT it.titulo, it.autor FROM favorita_item fi INNER JOIN item it ON fi.Item_id_item = it.id_item INNER JOIN usuario usr ON usr.id_usuario = ?',[$id_usr]);
        

        if ($busca == null)
            return response()->json(false);
        
        return response()->json($busca);
    }

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
