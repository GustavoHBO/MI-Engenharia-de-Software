<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\SecurityController;
use App\Http\Controllers\RelatorioController;

class NoticiaController extends Controller{


	/*
	Lista todas as noticias com as fotos
	*/
	public function listarNoticia(){
		$dados = DB::SELECT('SELECT * FROM noticia WHERE ativo = ?', [0]);
		foreach ($dados as $vetor) {
			$res_fotos = DB::SELECT('SELECT * FROM noticia_imagem WHERE Noticia_id_noticia = ?', [$vetor->id_noticia]);
			$vetor->info_imagens = array();
			$vetor->info_imagens = $res_fotos;
		}
		return response()->json($dados);
	}

	/*
	Busca uma noticia especifica pelo id. 
	$id_not é o id da noticia.
	retorna um vetor com os dados buscados.
	*/
	public function buscar_Id_Noticia($id_not){
		$id_not = addslashes($id_not);
		$resultados = DB::SELECT('SELECT * FROM noticia WHERE id_noticia LIKE ? and ativo = ?', [$id_not, 0]);
		
		foreach ($resultados as $vetor) {
			$res_fotos = DB::SELECT('SELECT * FROM noticia_imagem WHERE Noticia_id_noticia = ?', [$vetor->id_noticia]);
			$vetor->info_imagens = array();
			$vetor->info_imagens = $res_fotos;
		}
		
		return response()->json($resultados);
	}

	/*
		Busca uma noticia especifica pelo titulo
		retorna um vetor com os dados buscados
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
	retorna 'true' se o inseriu tanto na tabela noticia quanto na noticia_imagem 
	retorna #insertError01 se inseriu na tabela noticia e deu erro na inserção da tabela noticia_imagem
	retorna false se não consegiu inserir nem na tabela noticia nem na tabela noticia_image,
	*/
	public function cadastrarNoticia(Request $request){
		
		$data = date("Y-m-d H:i:s");

		$security = new SecurityController;
		$dados = $security->addbarras($request);

		$adicionado = DB::INSERT('INSERT INTO noticia (titulo, descricao, data_publicacao, ativo, Usuario_id_user) VALUES (?,?,?,?,?)', [$dados['titulo_noticia'], $dados['descricao_noticia'], $data , $dados['ativo_noticia'], $dados['id_usuario']]);

		if ($adicionado){
			$id_noticia = DB::SELECT('SELECT id_noticia FROM noticia WHERE titulo = ? AND descricao = ?',[$dados['titulo_noticia'], $dados['descricao_noticia']]);
			$add = DB::INSERT('INSERT INTO noticia_imagem VALUES (Noticia_id_noticia, foto_url)', [$id_noticia, $dados['foto_url']]);
			if ($add){
				return response()->json(true);
			}
			else{
				return response()->json('#insertError01');
			}
		}
		else{
			return response()->json(false);
		}
	}

	/*
	Atualiza a noticia. Atualiza todos os atributos de uma vez
	retorna 'true' se o atualizou a tabela noticia e inseriu a informação na tabela do relatorio 
	retorna #updateError01 se atualizou a tabela noticia a  tabela imagem_noticia, mas deu erro na inserção da tabela do relatorio
	retorna #updateError02 se atualizou a tabela noticia, mas nao conseguiu atualizar a tabela noticia_imagem
	retorna false se não consegiu atualizar a tabela noticia e nem as outras.
	*/
	public function atualizarNoticia(Request $request){

		$security = new SecurityController;
		$dados = $security->addbarras($request);

		$atualizado = DB::UPDATE('UPDATE noticia 
								  SET titulo = ?,
								      descricao = ?,
								      ativo = ?
								  WHERE id_noticia = ? and ativo == 0', [$dados['titulo_noticia'],$dados['descricao_noticia'],$dados['ativo_noticia'], $dados['id_usuario'],$dados['id_noticia'], $dados['ativo_noticia']]);

		if ($atualizado){
			
			$atualizado_imagem = DB::UPDATE('UPDATE noticia_imagem SET foto_url = ? WHERE id_noticia_imagem = ?', [$dados['foto_url'], $dados['id_noticia_imagem']]);
			if ($atualizado_imagem){
				$relatorio = new RelatorioController;
				$insere_relatorio = $relatorio->editaNoticia($dados['id_noticia'], $dados['id_funcionario']);

				if ($insere_relatorio){
					return response()->json(true);
				}
				else{
					return response()->json("#updateError01");
			}

			}
			else{
				return response()->json("#updateError02")
			}

			
		} 
		else{
			return response()->json(false);
		}
	}

	/*
	Metodo que atualiza a imgem da noticia.
	Request recebe como dados a foto da noticia (foto_url).
	o id da notcia que (id_noticia) e o id do funcionario (id_funcionairo) para inserir a info no relatorio


	retorna 'true' se o atualizou a tabela noticia_imagem e inseriu a informação na tabela do relatorio 
	retorna #updateError01 se atualizou a tabela noticia_imagem, mas deu erro na inserção da tabela do relatorio
	retorna 'false' se não consegiu atualizar a tabela noticia_imagem.
	*/
	public function atualizar_imagem_noticia(Request $request){

		$security = new SecurityController;
		$dados = $security->addbarras($request);

		$atualizado = DB::UPDATE('UPDATE noticia_imagem SET foto_url = ? WHERE id_noticia_imagem = ?', [$dados['foto_url'], $dados['id_noticia_imagem']]);

		if ($atualizado){
			$relatorio = new RelatorioController;
			$insere_relatorio = $relatorio->editaNoticia($dados['id_noticia'], $dados['id_funcionario']);
			if ($insere_relatorio){
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



	/*
	Este metodo eh responsavel por desativar uma noticia
	$id_noticia eh o id da noticia que vai ser desativa
	$id_funcionario eh o id do funcionario que está desativando.
	Esta ação é armazenada no relatorio.

	retorna 'true' se o setou ativo = 1 na tabela noticia e inseriu a informação na tabela do relatorio 
	retorna '#excluiError01' setou ativo = 1 a tabela noticia, mas deu erro na inserção da tabela do relatorio
	retorna 'false' se não consegiu setar ativo = 1 na tabela noticia.
	*/
	public function excluirNoticia (Request $request){

		$security = new SecurityController;
		$dados = $security->addbarras($request);
		
		$desabilita	= DB::UPDATE('UPDATE noticia SET ativo = ? WHERE id_noticia = ?', [1, $dados['id_noticia']]);

		if ($desabilita){
			$relatorio = new RelatorioController;
			$insere_relatorio = $relatorio->removeNoticia($dados['id_noticia'], $dados['id_funcionario']);
			if ($insere_relatorio){
				return response()->json(true);
			}
			else{
				return response()->json("#excluiError01");
			}	
		}
		else{
			return response()->json(false);
		}

	}


}