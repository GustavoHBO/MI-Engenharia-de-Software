<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\SecurityController;
use App\Http\Controllers\RelatorioController;

class NoticiaController extends Controller{

	/*
	Lista todas as noticias
	*/
	public function listarNoticia(){
		$dados = DB::SELECT('SELECT * FROM noticia WHERE ativo = ?', [0]);
		return response()->json($dados);
	}

	/*
		Busca uma noticia especifica pelo titulo
	*/
	public function buscarNoticia($key_word){
		$key_word = addslashes("%" . $key_word ."%");
		$resultados = DB::SELECT('SELECT * FROM noticia WHERE titulo LIKE ? and ativo = ?', [$key_word, 0]);
		
		foreach ($resultados as $vetor) {
			$res_fotos = DB::SELECT('SELECT * FROM noticia_imagem WHERE Noticia_id_noticia = ?', [$vetor->id_noticia]);
			$vetor->info_imagens = array();
			$vetor->info_imagens = $res_fotos;
		}
		
		return response()->json($resultados);
	}
	
	/*
	Metodo para cadastrar as noticias
	*/
	public function cadastrarNoticia(Request $request){

		$security = new SecurityController;
		$dados = $security->addbarras($request);

		$adicionado = DB::INSERT('INSERT INTO noticia (titulo, descricao, data_publicacao, ativo, Usuario_id_user) VALUES (?,?,?,?,?)', [$dados['titulo_noticia'], $dados['descricao_noticia'], $dados['data_publicacao'], $dados['ativo_noticia'], $dados['id_usuario']]);

		if ($adicionado){
			$id_noticia = DB::SELECT('SELECT id_noticia FROM noticia WHERE titulo = ? AND descricao = ? AND data_publicacao',[$titulo_noticia, $descricao_noticia, $data_publicacao]);
			$add = DB::INSERT('INSERT INTO noticia_imagem VALUES (?,?,?)', [$id_noticia, $dados['foto'], $dados['id_imagem']]);
			if ($add){
			return response()->json(true);
			}
			else{
				return response()->json(false);
			}
		}
		else{
			return response()->json(false);
		}
	}

	/*
	Atualiza a noticia. Atualiza todos os atributos de uma vez
	*/
	public function atualizarNoticia(Request $request){
		//$id_noticia, $titulo_noticia,$descricao_noticia,$data_publicacao,$ativo_noticia, $id_usuario

		$security = new SecurityController;
		$dados = $security->addbarras($request);

		$atualizado = DB::UPDATE('UPDATE noticia 
								  SET titulo = ?,
								      descricao = ?,
								      data_publicacao = ?,
								      ativo = ?
								  WHERE id_noticia = ? and ativo == 0', [$dados['titulo_noticia'],$dados['descricao_noticia'],$dados['data_publicacao'],$dados['ativo_noticia'], $dados['id_usuario'],$dados['id_noticia'], $dados['ativo_noticia']]);

		if ($atualizado){
			$relatorio = new RelatorioController;
			$insere_relatorio = $relatorio->editaNoticia($dados['id_noticia'], $dados['id_usuario']);
			if ($insere_relatorio){
				return response()->json(true);
			}
			else{
				return response()->json(false);
			}
		} 
		else{
			return response()->json(false);
		}
	}
	/*
	Este metodo eh responsavel por desativar uma noticia
	$id_noticia eh o id da noticia que vai ser desativa
	$id_funcionario eh o id do funcionario que está desativando.
	Esta ação é armazenada no relatorio.
	*/
	public function excluirNoticia ($id_noticia, $id_funcionario){
		$desabilita	= DB::UPDATE('UPDATE noticia SET ativo = ? WHERE id_noticia = ?', [1, $id_noticia]);

		if ($desabilita){
			$relatorio = new RelatorioController;
			$insere_relatorio = $relatorio->removeNoticia($id_noticia, $id_funcionario);
			if ($insere_relatorio){
				return response()->json(true);
			}	
		}
		else{
			return response()->json(false);
		}

	}


}