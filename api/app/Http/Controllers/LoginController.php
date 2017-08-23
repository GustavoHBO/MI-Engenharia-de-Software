<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\SecurityController;

class LoginController extends Controller
{
    /**
     * Método logar no sistema..
     * @author Lindelmo Havallon
     * @param Resquest $request
     * @return response - O usuario conectado ao sistema.
     */
    public function login(Request $request){
        $dados = $request->all(); 
        $security = new SecurityController;

        $busca = DB::SELECT('SELECT * FROM usuario WHERE id_usuario = ?',
        [$dados['id']]);

        if ($busca == null){
            $add = DB::INSERT('INSERT INTO usuario (id_usuario, nome, sobrenome, tipo) VALUES (?, ?, ?, ?)',
            [$dados['id'], $dados['nome'], $dados['sobrenome'], 'c']);
            
            $user = array();
            $user['id'] = $dados['id'];
            $user['nome']       = $dados['nome'];
            $user['sobrenome']  = $dados['sobrenome'];
            $user['ativo']      = 0;
            $user['tipo']       = 'c';

            return response()->json($user);
        } else {
            $busca = $busca[0];
            if ($busca->ativo == 1){
                return response()->json(false);
            } else {
                return response()->json($busca);
            }
        }
    }

}
