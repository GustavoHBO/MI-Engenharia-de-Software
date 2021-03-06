<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\RelatorioController;
use App\Http\Controllers\SecurityController;

class ExposicaoController extends Controller{


	/**
	*Busca por uma palavra chave
	*@author Murilo Lopes
	*@param $key_word
	*@return Response - um vetor com as exposicoes
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

	/**
	*Busca pelo id
	*@author Murilo Lopes
	*@param $id_exposicao
	*@return Response - um vetor com as exposicoes
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

	/**
	*Metodo responsavel pelo cadastro de novas exposicoes
	*@author Murilo Lopes
	*@param Request $request
	*@return Boolean se ocorreu a insercao ou nao. String caso ocorra erro na hora de inserir no relatorio
	*/
	public function cadastrarExposicao(Request $request){

		$security = new SecurityController;
		$dados = $security->addbarras($request);
		$id_itens = $dados['id_item'];

		$adicionado = DB::INSERT('INSERT INTO exposicao (data_inicio, data_termino, categoria, descricao, ativo, titulo) VALUES (?,?,?,?,?,?)',[$dados['data_inicio'], $dados['data_termino'], $dados['categoria'], $dados['descricao'], 0, $dados['titulo']]);

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


	/**
	*Metodo que retorna as exposicoes que possuem os item ativos
	*@author Murilo Lopes
	*@return Response - response com os dados obtidos
	*/
	public function listarExposicao(){
		$dados = DB::SELECT('SELECT * FROM exposicao');
		foreach ($dados as $vetor) {
			$dados_item = DB::SELECT('SELECT item_exposicao.Item_id_item, item.titulo FROM item INNER JOIN item_exposicao ON item_exposicao.Item_id_item = item.id_item AND item_exposicao.Exposicao_id_exposicao = ? and item.ativo = ?',[$vetor->id_exposicao, 0]);
			$vetor->info_item = array();
			$vetor->info_item = $dados_item;
		}
		return response()->json($dados);
	}
	/**
	*Metodo que retorna todas as exposicoes que estao ativas.
	*@author Murilo Lopes
	*@return Response - response com os dados obtidos
	*/
	public function listarExposicaoAtivos(){
		$dados = DB::SELECT('SELECT * FROM exposicao WHERE ativo = ?',  [0]);
		foreach ($dados as $vetor) {
			$dados_item = DB::SELECT('SELECT item_exposicao.Item_id_item, item.titulo FROM item INNER JOIN item_exposicao ON item_exposicao.Item_id_item = item.id_item AND item_exposicao.Exposicao_id_exposicao = ? and item.ativo = ?',[$vetor->id_exposicao, 0]);
			$vetor->info_item = array();
			$vetor->info_item = $dados_item;
		}
		return response()->json($dados);
	}

	/**
	*Metodo que retorna todas as exposicoes que nao possui itens ativos
	*@author Murilo Lopes
	*@return Response - response com os dados obtidos
	*/
	public function listarExposicaoTodos(){
		$dados = DB::SELECT('SELECT * FROM exposicao');
		foreach ($dados as $vetor) {
			$dados_item = DB::SELECT('SELECT item_exposicao.Item_id_item, item.titulo FROM item INNER JOIN item_exposicao ON item_exposicao.Item_id_item = item.id_item AND item_exposicao.Exposicao_id_exposicao = ?',[$vetor->id_exposicao]);
			$vetor->info_item = array();
			$vetor->info_item = $dados_item;
		}
		return response()->json($dados);
	}


	/**
	*Metodo que realiza a atualizao de uma exposicao
	*@author Murilo Lopes
	*@param Request $request
	*@return  Booleano se ocorreu ou nao a atualizacao com sucesso. String caso tenha ocorrido erro de insercao no relatorio
	*/
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
				$foi = $relatorio->editaExposicao($dados['id_exposicao'], $dados['id_funcionario']);
				if ($foi){
					return response()->json(true);
				}
				else{
					return response()->json('#updateError01'); 
				}
			}
			else{
				return response()->json(false);
			}
		

	}

	/**
	*Metodo que torna inativo uma exposicao
	*@author Murilo Lopes
	*@param Request $request
	*@return Booleano se ocorreu ou nao a remocao com sucesso. String caso tenha ocorrido erro de insercao no relatorio
	*/
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
				return response()->json('#excluirError01');
			}
		}

		else{
			return response()->json(false);
		}
	}



}