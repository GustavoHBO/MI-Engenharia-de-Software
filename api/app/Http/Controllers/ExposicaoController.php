<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Controllers\RelatorioController;

class ExposicaoController extends Controller{

	public function buscarExposicao($key_word){
		$key_word = addslashes("%".$key_word."%");
		$dados = DB::SELECT('SELECT * FROM exposicao WHERE titulo LIKE ? and ativo = ?', [$key_word, 0]);
		return response()->json($dados);
	}

	public function cadastrarExposicao($data_inicio, $data_termino, $categoria, $descricao, $ativo, $titulo, $id_item){
		
		$adicionado = DB::INSERT('INSERT INTO exposicao (data_inicio, data_termino, categoria, descricao, ativo, titulo)VALUES (?,?,?,?)',[$data_inicio, $data_termino, $categoria, $descricao, $ativo, $titulo]);

		if ($adicionado){
			$id_exposicao = DB::SELECT('SELECT id_exposicao FROM exposicao WHERE titulo = ? and descricao = ? data_inicio = ?', [$titulo, $descricao, $data_inicio]);
			for 
			return response()->json(true);

		}
		else{
			return response()->json(false);
		}
	}



	public function listarExposicao(){
		$todos = DB::('SELECT * FROM exposicao WHERE ativo == ?', [0]);
		return response()->json($todos)
	}

	

	public function atualizarExposicao($id_exposicao){
		return "id exposicao editada: " .$id_exposicao;

	}

	
	public function excluirExposicao($id_exposicao, $id_funcionario){
		$removido = DB::UPDATE('UPDATE exposicao SET ativo = ? WHERE id_exposicao', [1, $id_exposicao]);
		
		if ($removido){
			$relatorio = new RelatorioController;
			$adicionado = $relatorio->removeExposicao($id_exposicao, $id_funcionario);
			if ($adicionado){
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



}
