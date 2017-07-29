<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\SecurityController;

class FuncionarioController extends Controller
{
    //Método para cadastrar usuário
    public function create(Request $request){
        $security = new SecurityController;
        $dados =  $security->addbarras($request);

        $add = DB::INSERT('INSERT INTO usuario (id_usuario, nome, sobrenome, tipo) VALUES (?, ?, ?, ?)',
        [$dados['id'], $dados['nome'], $dados['sobrenome'], 'f']);

        if ($dados['gerenciar_itens'])
            $add = DB::INSERT('INSERT INTO permissao (tipo, Usuario_id_usuario) VALUES (0, ?)',
            [$dados['id']]);
        
        if ($dados['gerenciar_eventos'])
            $add = DB::INSERT('INSERT INTO permissao (tipo, Usuario_id_usuario) VALUES (1, ?)',
            [$dados['id']]);
        
        if ($dados['gerenciar_noticias'])
            $add = DB::INSERT('INSERT INTO permissao (tipo, Usuario_id_usuario) VALUES (2, ?)',
            [$dados['id']]);
        
        
        if ($add){
            return response()->json(true);
        } else {
            return response()->json(false);
        }
    }
    
    //Lendo todos os usuarios do banco
    public function readAll(){
        $busca = DB::SELECT('SELECT * FROM usuario WHERE tipo = ? ORDER BY nome',['f']);
        foreach ($busca as $b){
            $permissao = DB::SELECT('SELECT tipo FROM permissao WHERE Usuario_id_usuario = ?',
            [$b->id_usuario]);
            
            $b->gerenciar_itens = false;
            $b->gerenciar_eventos = false;
            $b->gerenciar_noticias = false;

            foreach ($permissao as $p){
                if ($p->tipo == 0)
                    $b->gerenciar_itens = true;
                else if ($p->tipo == 1)
                    $b->gerenciar_eventos = true;
                else
                    $b->gerenciar_noticias = true;
            }

        }
        return response()->json($busca);
    }

    //Buscar um usuario
    public function read($id){
        $busca = DB::SELECT('SELECT * FROM usuario WHERE id_usuario = ?', [$id]);
        if ($busca == null)
            return response()->json(false);
        $busca = $busca[0];
        $permissao = DB::SELECT('SELECT tipo FROM permissao WHERE Usuario_id_usuario = ?',
        [$busca->id_usuario]);

        $busca->gerenciar_itens = false;
        $busca->gerenciar_eventos = false;
        $busca->gerenciar_noticias = false;

        foreach ($permissao as $p){
            if ($p->tipo == 0)
                $busca->gerenciar_itens = true;
            else if ($p->tipo == 1)
                $busca->gerenciar_eventos = true;
            else
                $busca->gerenciar_noticias = true;
        }

        return response()->json($busca);
    }

    //Alterando os usuarios
    public function update(Request $request) {
        $security = new SecurityController;
        $dados =  $security->addbarras($request);

        $update = DB::UPDATE('UPDATE usuario SET nome = ?, sobrenome = ? WHERE id_usuario = ?',
        [$dados['nome'], $dados['sobrenome'], $dados['id']]);

        $delete = DB::DELETE('DELETE FROM permissao WHERE Usuario_id_usuario = ?',
        [$dados['id']]);

        if ($dados['gerenciar_itens'])
            $add = DB::INSERT('INSERT INTO permissao (tipo, Usuario_id_usuario) VALUES (0, ?)',
            [$dados['id']]);
        
        if ($dados['gerenciar_eventos'])
            $add = DB::INSERT('INSERT INTO permissao (tipo, Usuario_id_usuario) VALUES (1, ?)',
            [$dados['id']]);
        
        if ($dados['gerenciar_noticias'])
            $add = DB::INSERT('INSERT INTO permissao (tipo, Usuario_id_usuario) VALUES (2, ?)',
            [$dados['id']]);

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
