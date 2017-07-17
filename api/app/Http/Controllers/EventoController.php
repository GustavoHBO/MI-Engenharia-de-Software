<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class EventoController extends Controller
{
 
    /*CADASTRO DE EVENTO*/
    public function cadastroEvento(Request $request){
        $dados = $request->all();
        
        //verifica se já não existe um evento cadastrado
        $busca = DB::SELECT('SELECT titulo FROM evento WHERE titulo = ?',
        [$dados['titulo']]);

        if ($busca != null)
            return response()->json(false);            
       
        $add = DB::INSERT('INSERT INTO evento (titulo, local, responsavel, foto_url, artista, horario_visitacao, data_inicio, data_fim, categoria, ativo) VALUES (?,?,?,?,?,?,?,?,?,?)',
        [$dados['titulo'],$dados['local'], $dados['responsavel'], $dados['foto_url'], $dados['artista'], $dados['horario_visitacao'], $dados['data_inicio'], $dados['data_fim'], $dados['categoria'], $dados['ativo']]);

       
        if  ($add){
            return response()->json(true);
        } else {
            return response()->json(false);
        }
    }
    /*BUSCA TODOS EVENTOS*/
    public function todosEventos(){
        $busca = DB::SELECT('SELECT titulo, local, responsavel, foto_url, artista, horario_visitacao, data_inicio, data_fim, categoria, ativo FROM evento');
        return response()->json($busca);
    }
    /*BUSCA UM EVENTO*/
    public function buscarEvento($id){
        $busca = DB::SELECT('SELECT titulo, local, responsavel, foto_url, artista, horario_visitacao, data_inicio, data_fim, categoria, ativo FROM evento WHERE id_evento = ?',
        [$id]);
        if ($busca == null)
            return response()->json(false);
        
        $busca = $busca[0];
        return response()->json($busca);
    }
    /*EDITAR EVENTO*/
    public function editarEvento (Request $request){
        $dados = $request->all();

        $update = DB::UPDATE('UPDATE evento SET titulo = ?, local = ?, responsavel = ?, foto_url = ?, artista = ?, horario_visitacao = ?, data_inicio = ?, data_fim = ?, categoria = ?, ativo = ? WHERE id_evento = ?',
        [$dados['titulo'],$dados['local'], $dados['responsavel'], $dados['foto_url'], $dados['artista'], $dados['horario_visitacao'], $dados['data_inicio'], $dados['data_fim'], $dados['categoria'], $dados['ativo'],$dados['id_evento'] ]);

        if  ($update){
            return response()->json(true);
        } else {
            return response()->json(false);
        }

    }
    /*REMOVE EVENTO*/
    public function removerEvento (Request $request){
        $dados = $request->all();

        $delete = DB::DELETE('DELETE FROM evento WHERE id_evento = ?', [$dados['id_evento']]);

        if  ($delete){
            return response()->json(true);
        } else {
            return response()->json(false);
        }

    }

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

    public function todosEventosFavoritos($id_usr){
    //FALTA COLOCAR O RETORNO CERTO
        $busca = DB::SELECT('SELECT ev.titulo FROM favorita_evento fe INNER JOIN evento ev ON fe.Evento_id_evento = ev.id_evento INNER JOIN usuario usr ON usr.id_usuario = ?',[$id_usr]);
        
        if ($busca == null)
            return response()->json(false);
        
        return response()->json($busca);
    }

    public function removerFavorito (Request $request){
        $dados = $request->all();

        $delete = DB::DELETE('DELETE FROM favorita_evento WHERE favorita_evento.Evento_id_evento = ? AND favorita_evento.Usuario_id_usuario = ?', [$dados['id_evento'],$dados['id_usr']]);

        if  ($delete){
            return response()->json(true);
        } else {
            return response()->json(false);
        }

    }








}
