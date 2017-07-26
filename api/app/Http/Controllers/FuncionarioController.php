<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\SecurityController;

class FuncionarioController extends Controller
{
    //Método para cadastrar funcionario
    public function create(Request $request){
        $security = new SecurityController;
        $dados =  $security->addbarras($request);

        $add = DB::INSERT('INSERT INTO usuario (id_usuario, nome, sobrenome, tipo) VALUES (?, ?, ?, ?)',
        [$dados['id'], $dados['nome'], $dados['sobrenome'], 'f']);

        foreach ($dados['permissoes'] as $p){
            $add = DB::INSERT('INSERT INTO permissao (tipo, Usuario_id_usuario) VALUES (?, ?)',
            [$p,$dados['id']]);
        }
        
        if ($add){
            return response()->json(true);
        } else {
            return response()->json(false);
        }
    }
    
    //Lendo todos os funcionario do banco
    public function readAll(){
        $busca = DB::SELECT('SELECT * FROM usuario WHERE tipo = ? ORDER BY nome',['f']);
        foreach ($busca as $b){
            $permissao = DB::SELECT('SELECT tipo FROM permissao WHERE Usuario_id_usuario = ?',
            [$b->id_usuario]);
            $b->permissoes = $permissao;
        }
        return response()->json($busca);
    }

    //Buscar um funcionario
    public function read($id){
        $busca = DB::SELECT('SELECT * FROM usuario WHERE id_usuario = ?', [$id]);
        if ($busca == null)
            return response()->json(false);
        $busca = $busca[0];
        $permissao = DB::SELECT('SELECT tipo FROM permissao WHERE Usuario_id_usuario = ?',
        [$busca->id_usuario]);
        $busca->permissoes = $permissao;
        return response()->json($busca);
    }

    //Alterando os funcionarios
    public function update(Request $request) {
        $security = new SecurityController;
        $dados =  $security->addbarras($request);

        $update = DB::UPDATE('UPDATE usuario SET nome = ?, sobrenome = ? WHERE id_usuario = ?',
        [$dados['nome'], $dados['sobrenome'], $dados['id']]);

        $delete = DB::DELETE('DELETE FROM permissao WHERE Usuario_id_usuario = ?',
        [$dados['id']]);

        foreach ($dados['permissoes'] as $p){
            $add = DB::INSERT('INSERT INTO permissao (tipo, Usuario_id_usuario) VALUES (?, ?)',
            [$p,$dados['id']]);
        }

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
