<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\SecurityController;

class UsuarioController extends Controller
{
    //Método para cadastrar usuário
    public function create(Request $request){
        $security = new SecurityController;
        $dados =  $security->addbarras($request);

        $add = DB::INSERT('INSERT INTO usuario (id_usuario, nome, sobrenome, tipo) VALUES (?, ?, ?, ?)',
        [$dados['id'], $dados['nome'], $dados['sobrenome'], 'c']);

        if ($add){
            return response()->json(true);
        } else {
            return response()->json(false);
        }
    }
    
    //Lendo todos os usuarios do banco
    public function readAll(){
        $busca = DB::SELECT('SELECT nome, sobrenome, foto FROM usuario ORDER BY nome');
        return response()->json($busca);
    }

    //Alterando os usuarios
    public function update(Request $request) {
        $security = new SecurityController;
        $dados =  $security->addbarras($request);

        $update = DB::UPDATE('UPDATE usuario SET nome = ?, sobrenome = ?, foto = ? WHERE id_usuario = ?',
        [$dados['nome'], $dados['sobrenome'], $dados['foto'], $dados['id']]);

        if ($update){
            return response()->json(true);
        } else {
            return response()->json(false);
        }
    }

    public function desativar(Request $request){
        $security = new SecurityController;
        $dados =  $security->addbarras($request);

        $update = DB::UPDATE('UPDATE usuario SET ativo = ? WHERE id_usuario = ?',
        [1, $dados['id']]);

        if ($update){
            return response()->json(true);
        } else {
            return response()->json(false);
        }
    }
}
