<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class NoticiaController extends Controller{

	/*
	Lista todas as noticias
	*/
	public function listarNoticia(){
		$dados = DB::SELECT('SELECT * FROM noticia');
		return response()->json($dados);
	}

	/*
		Busca uma noticia especifica pelo titulo dela
		Ainda falta implentar o comando LIKE que eu ainda nao consegui
	*/
	public function buscarNoticia($key_word){
		$dados = DB::SELECT('SELECT * FROM noticia WHERE titulo = ?', [$key_word]);
		return response()->json($dados);
	}
	/*
	Metodo para cadastrar as noticias
	*/
	public function cadastrarNoticia($titulo_noticia,$descricao_noticia,$data_publicacao,$ativo_noticia, $id_usuario){

		$adicionado = DB::INSERT('INSERT INTO noticia (titulo, descricao, data_publicacao, ativo, Usuario_id_user) VALUES (?,?,?,?,?)', [$titulo_noticia,$descricao_noticia,$data_publicacao,$ativo_noticia, $id_usuario]);

		if ($adicionado){
			return response()->json(true);
		}
		else{
			return response()->json(false);
		}
	}

	/*
	Atualiza a noticia. Atualiza todos os atributos de uma vez
	*/
	public function atualizarNoticia($id_noticia, $titulo_noticia,$descricao_noticia,$data_publicacao,$ativo_noticia, $id_usuario){
		$atualizado = DB::UPDATE('UPDATE noticia 
								  SET titulo = ?,
								      descricao = ?,
								      data_publicacao = ?,
								      ativo = ?,
								      Usuario_id_user = ?,
								  WHERE id_noticia = ?', [$titulo_noticia,$descricao_noticia,$data_publicacao,$ativo_noticia, $id_usuario,$id_noticia]);

		if ($atualizado){
			return response()->json(true);
		} 
		else{
			return response()->json(false);
		}
	}
	/*
	Exclui uma noticia especifica
	*/
	public function excluirNoticia($id_noticia){
		return "esse metodo exclui uma noticia: " .$id_noticia;
	}


}