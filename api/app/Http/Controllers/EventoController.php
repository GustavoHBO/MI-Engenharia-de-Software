<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class EventoController extends Controller
{
    protected $controllerRelatorio;

    public function __construct()
    {
        $this->relatorioController = new RelatorioController;
    }
    /**
     * MÉTODO CADASTRO DE EVENTO. obs:o evento já fica ativo
     * @author Gabriel Gomes
     * @param  Request
     * @return boolean, se cadastrou evento
     */
    public function cadastroEvento(Request $request){
        $dados = $request->all();
   
        $add = DB::INSERT('INSERT INTO evento (titulo, local, responsavel, foto_url, artista, horario_visitacao, data_inicio, data_fim, categoria, ativo) VALUES (?,?,?,?,?,?,?,?,?,?)',
        [$dados['titulo'],$dados['local'], $dados['responsavel'], $dados['foto_url'], $dados['artista'], $dados['horario_visitacao'], $dados['data_inicio'], $dados['data_fim'], $dados['categoria'],1]);

       
        if  ($add){
            //$relatorioController->criarEvento($dados['id_evento'],$dados['id_usuario']);
            return response()->json(true);
        } else {
            return response()->json(false);
        }
    }
    /**
     * MÉTODO BUSCA TODOS EVENTOS
     * @author Gabriel Gomes
     * @return todos eventos
     */
    public function todosEventos(){
        $busca = DB::SELECT('SELECT * FROM evento ORDER BY id_evento');
        return response()->json($busca);
    }
    /**
     * MÉTODO TODOS EVENTOS ATIVOS
     * @author Gabriel Gomes
     * @return todos eventos ativos
     */
    public function todosEventosAtivos(){
        $busca = DB::SELECT('SELECT * FROM evento WHERE ativo = 1 ORDER BY id_evento');
        return response()->json($busca);
    }
    /**
     * MÉTODO BUSCA UM EVENTO PELO ID
     * @author Gabriel Gomes
     * @param id
     * @return evento
     */
    public function buscarEvento($id){
        $busca = DB::SELECT('SELECT * FROM evento WHERE id_evento = ?',
        [$id]);
        if ($busca == null)
            return response()->json(false);
        
        $busca = $busca[0];
        return response()->json($busca);
    }
    /**
     * MÉTODO PESQUISAR UM EVENTO PELO TITULO
     * @author Gabriel Gomes
     * @param titulo
     * @return evento
     */
    public function pesquisarEvento($titulo){
        $busca = DB::SELECT('SELECT * FROM evento WHERE titulo LIKE ? ORDER BY titulo',
        ["%".$titulo."%"]);
        if ($busca == null)
            return response()->json(false);        
    
        return response()->json($busca);
    }
    /**
     * MÉTODO EDITAR EVENTO
     * @author Gabriel Gomes
     * @param Request
     * @return boolean, se o evento foi alterado
     */
    public function editarEvento (Request $request){
        $dados = $request->all();

        $update = DB::UPDATE('UPDATE evento SET titulo = ?, local = ?, responsavel = ?, foto_url = ?, artista = ?, horario_visitacao = ?, data_inicio = ?, data_fim = ?, categoria = ? WHERE id_evento = ?',
        [$dados['titulo'],$dados['local'], $dados['responsavel'], $dados['foto_url'], $dados['artista'], $dados['horario_visitacao'], $dados['data_inicio'], $dados['data_fim'], $dados['categoria'], $dados['id_evento'] ]);

        if  ($update){
            //$relatorioController->editaEvento($dados['id_evento'],$dados['id_usuar'io]);
            return response()->json(true);
        } else {
            return response()->json(false);
        }

    }
    /**
     * MÉTODO DESATIVA EVENTO
     * @author Gabriel Gomes
     * @param Request
     * @return boolean, se o evento foi desativado
     */
    public function desativaEvento (Request $request){
        $dados = $request->all();

       $update = DB::UPDATE('UPDATE evento SET ativo = 0 WHERE id_evento = ?', [$dados['id_evento'] ]);

        if  ($update){
            //$relatorioController->removeEvento($dados['id_evento'],$dados['id_usuario']);
            return response()->json(true);
        } else {
            return response()->json(false);
        }

    }
    /**
     * MÉTODO ATIVA EVENTO
     * @author Gabriel Gomes
     * @param  Request
     * @return boolean, se o evento foi ativado
     */
    public function ativaEvento (Request $request){
        $dados = $request->all();

       $update = DB::UPDATE('UPDATE evento SET ativo = 1 WHERE id_evento = ?', [$dados['id_evento'] ]);

        if  ($update){
            return response()->json(true);
        } else {
            return response()->json(false);
        }

    }
    /**
     * MÉTODO FAVORITA EVENTO
     * @author Gabriel Gomes
     * @param Request
     * @return boolean, se o evento foi favoritado
     */
    public function favoritaEvento(Request $request){
        $dados = $request->all();

        $busca = DB::SELECT('SELECT favorita_evento.Evento_id_evento, favorita_evento.Usuario_id_usuario FROM favorita_evento WHERE favorita_evento.Evento_id_evento = ? AND favorita_evento.Usuario_id_usuario = ?',
        [$dados['id_evento'],$dados['id_usuario']]);

        if ($busca != null)
            return response()->json(false);

        $add = DB::INSERT('INSERT INTO favorita_evento (Evento_id_evento, Usuario_id_usuario) VALUES (?, ?)',
        [$dados['id_evento'], $dados['id_usuario']]);

        if  ($add){
            return response()->json(true);
        } else {
            return response()->json(false);
        }
    }
    /**
     * MÉTODO LISTA TODOS EVENTOS FAVORITOS
     * @author Gabriel Gomes
     * @param id do usuário
     * @return todos eventos favoritados por um usuario
     */
    public function todosEventosFavoritos($id_usuario){
        $busca = DB::SELECT('SELECT ev.titulo,ev.local, ev.responsavel,  ev.foto_url,  ev.artista,  ev.horario_visitacao,  ev.data_inicio,  ev.data_fim,  ev.categoria FROM favorita_evento fe INNER JOIN evento ev ON fe.Evento_id_evento = ev.id_evento INNER JOIN usuario usr ON usr.id_usuario = ?',[$id_usuario]);
        
        if ($busca == null)
            return response()->json(false);
        
        return response()->json($busca);
    }
    /**
     * MÉTODO REMOVE EVENTO DOS FAVORITOS
     * @author Gabriel Gomes
     * @param Request
     * @return boolean, se o evento foi removido dos favoritos
     */
    public function removerFavorito (Request $request){
        $dados = $request->all();

        $delete = DB::DELETE('DELETE FROM favorita_evento WHERE favorita_evento.Evento_id_evento = ? AND favorita_evento.Usuario_id_usuario = ?', [$dados['id_evento'],$dados['id_usuario']]);

        if  ($delete){
            return response()->json(true);
        } else {
            return response()->json(false);
        }

    }








}
