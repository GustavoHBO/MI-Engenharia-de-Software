<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\RelatorioController;
use App\Http\Controllers\SecurityController;

class ExposicaoController extends Controller{


	/*
	Busca por uma palavra chave
	
	*/
	public function buscarExposicao($key_word){
		$key_word = addslashes("%".$key_word."%");
		$dados = DB::SELECT('SELECT * FROM exposicao WHERE titulo LIKE ? and ativo = ?', [$key_word, 0]);
		foreach ($dados as $vetor) {
			$dados_item = DB::SELECT('SELECT item_exposicao.Item_id_item, item.titulo FROM item INNER JOIN item_exposicao ON item_exposicao.Item_id_item = item.id_item AND item_exposicao.Exposicao_id_exposicao = ? and item.ativo = ?',[(int)$vetor->id_exposicao, 0]);
			$vetor->info_item = array();
			$vetor->info_item = $dados_item;
		}

		return response()->json($dados);
	}

	/*
	Busca pelo id
	
	*/
	public function buscarExposicao_id($id_exposicao){
			$id_exposicao = addslashes($id_exposicao);
		$dados = DB::SELECT('SELECT * FROM exposicao WHERE id_exposicao = ? and ativo = ?', [$id_exposicao, 0]);
		foreach ($dados as $vetor) {
			$dados_item = DB::SELECT('SELECT item_exposicao.Item_id_item, item.titulo FROM item INNER JOIN item_exposicao ON item_exposicao.Item_id_item = item.id_item AND item_exposicao.Exposicao_id_exposicao = ? and item.ativo = ?',[$vetor->id_exposicao, 0]);
			$vetor->info_item = array();
			$vetor->info_item = $dados_item;
		}

		return response()->json($dados);
	}

	/*
	#cadastroError01 erro na hora de inserir no relatorio
	//data_inicio,data_termino,categoria,descricao,titulo, id_item, id_usuario
	*/
	public function cadastrarExposicao(Request $request){
		//$id_item = array('1','2','3');

		$security = new SecurityController;
		$dados = $security->addbarras($request);
		$id_itens = $dados['id_item'];

		$adicionado = DB::INSERT('INSERT INTO exposicao (data_inicio, data_termino, categoria, descricao, ativo, titulo)VALUES (?,?,?,?,?)',[$dados['data_inicio'], $dados['data_termino'], $dados['categoria'], $dados['descricao'], 0, $dados['titulo']]);

		if ($adicionado){
			$id_exposicao = DB::SELECT('SELECT id_exposicao FROM exposicao WHERE titulo = ? and descricao = ?', [$dados['titulo'], $dados['descricao']]);
			$relatorio_cria_exposicao = new RelatorioController;
			$foi = $relatorio_cria_exposicao->criarExposicao((int)$id_exposicao, $dados['id_usuario']);
			if($foi){
				for ($i = 0; $i < count($id_itens); $i++){
					$adicionado_item_exposicao = DB::INSERT('INSERT INTO item_exposicao (Item_id_item, Exposicao_id_exposicao) VALUES (?,?) ', [$id_itens[$i], (int)$id_exposicao]);
			}
			
			return response()->json(true);
			}
			else{
				return response()->json('#cadastroError01');
			}
			
		}
		else{
			return response()->json(false);
		}
	}



	public function listarExposicao(){
		$dados = DB::SELECT('SELECT * FROM exposicao WHERE ativo = ?',  [0]);
		foreach ($dados as $vetor) {
			$dados_item = DB::SELECT('SELECT item_exposicao.Item_id_item, item.titulo FROM item INNER JOIN item_exposicao ON item_exposicao.Item_id_item = item.id_item AND item_exposicao.Exposicao_id_exposicao = ? and item.ativo = ?',[$vetor->id_exposicao, 0]);
			$vetor->info_item = array();
			$vetor->info_item = $dados_item;
		}
		return response()->json($dados);
	}

	//Nomes dos vetores no metodo request
	//data_inicio, data_termino, categoria, descricao, titulo, id_exposicao, id_usuario
	public function atualizarExposicao(Request $request){
			
			$security = new SecurityController;
			$dados = $security->addbarras($request);
			
			

			$atualizado = DB::UPDATE('UPDATE exposicao SET data_inicio = ?,
														   data_termino = ?,
														   categoria = ?,
														   descricao = ?,
														   titulo = ?
														   WHERE ativo = ? AND id_exposicao = ?
															', [$dados['data_inicio'], $dados['data_termino'], $dados['categoria'], $dados['descricao'], $dados['titulo'], 0, $dados['id_exposicao']]);

			if($atualizado){
				$relatorio = new RelatorioController;
				$foi = $relatorio->editaExposicao($dados['id_exposicao'], $dados['id_usuario']);
				if ($foi)
					return response()->json(true);
				else{
					return response()->json('#updateError01'); 
				}
			}
			else{
				return response()->json(false);
			}
		

	}

	
	public function excluirExposicao(Request $request){
		//$id_exposicao, $id_funcionario
		$security = new SecurityController;
		$dados = $security->addbarras($request);
		
		$removido = DB::UPDATE('UPDATE exposicao SET ativo = ? WHERE id_exposicao', [1, $dados['id_exposicao']]);
		
		if ($removido){
			$relatorio = new RelatorioController;
			$adicionado = $relatorio->removeExposicao($dados['id_exposicao'], $dados['id_funcionario']);
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
