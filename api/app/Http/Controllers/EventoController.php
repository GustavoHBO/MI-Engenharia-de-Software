<?php

namespace App\Http\Controllers;

class EventoController extends Controller{
    
    public function __construct() {
        //
    }
   /* EVENTO */
    
    public function indexEvento() {
        return 'index';
    }

    /* Cadastro Evento */
    public function cadastroEvento($nome, $data_inicio, $data_fim, $local, $responsavel) {
        $inserir = DB::INSERT('INSERT INTO evento(nome, data_inicio, data_fim, local, responsavel) VALUES (?,?,?,?,?)', [$nome, $data_inicio, $data_fim, $local, $responsavel]);

        if ($inserir) {
            return response()->json(true);
        } else {
            return response()->json(false);
        }
    }
    /* Gerenciamento Evento */
    public function gerenciamentoEvento() {
        return 'gerenciamento';
    }
    /* Editar Evento */
    public function editarEvento($idevento, $nome, $data_inicio, $data_fim, $local, $responsavel) {
        $editado = DB::UPDATE('UPDATE evento SET idevento = ?, nome = ?, data_inicio = ?, data_fim = ?, local = ?, responsavel = ? WHERE $idevento = ?', [$idevento, $nome, $data_inicio, $data_fim, $local, $responsavel, $idevento]);

        if ($editado) {
            return response()->json(true);
        } else {
            return response()->json(false);
        }
    }
    /* Listar Evento */
    public function listarEvento() {
        $informacoes = DB::SELECT('SELECT * FROM evento');
        return response()->json($informacoes);
    }
    /* Excluir Evento */
    public function excluirEvento($idevento) {
        
        /*$deletado = DB::DELETE('DELETE evento WHERE idevento = ?',$idevento);*/
        
        return 'excluir' . $idevento;
    }
    /* Visualizar Evento */
    public function visualizarEvento($idevento) {
        
        /*$informacao = DB::SELECT('SELECT * FROM evento WHERE idevento = ?',[$idevento]);
        return response()->json($informacoes);*/
                
        return 'visualizar' . $idevento;
    }
    
}