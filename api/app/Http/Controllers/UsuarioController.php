<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\SecurityController;

class UsuarioController extends Controller
{
   /**
     * Método para criar um novo usuario no sistema.
     * @author Lindelmo Havallon
     * @param  Request  $request
     * @return boolean - Retorna se o usuario foi cadastrado com sucesso.
     */
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
    
    /**
     * Método para listar todos os usuarios do sistema.
     * @author Lindelmo Havallon
     * @return response - Funcionários previamente usuarios.
     */
    public function readAll(){
        $busca = DB::SELECT('SELECT * FROM usuario WHERE tipo = ? ORDER BY nome', ['c']);
        return response()->json($busca);
    }

   /**
     * Método para exibir um usuario especifico no sistema.
     * @author Lindelmo Havallon
     * @param int - Id do usuario.
     * @return response - usuario correspondente ao id de entrada.
     */
    public function read($id){
        $busca = DB::SELECT('SELECT * FROM usuario WHERE id_usuario = ?', [$id]);
        if ($busca == null)
            return response()->json(false);
        $busca = $busca[0];
        return response()->json($busca);
    }

    /**
     * Método para alterar um usuario previamente cadastrado no sistema.
     * @author Lindelmo Havallon
     * @param Resquest  $request
     * @return boolean - Retorna se a alteração foi feita com sucesso.
     */
    public function update(Request $request) {
        $security = new SecurityController;
        $dados =  $security->addbarras($request);

        $update = DB::UPDATE('UPDATE usuario SET nome = ?, sobrenome = ? WHERE id_usuario = ?',
        [$dados['nome'], $dados['sobrenome'], $dados['id']]);

        if ($update){
            return response()->json(true);
        } else {
            return response()->json(false);
        }
    }

    /**
     * Método para desativar um usuario previamente cadastrado no sistema.
     * @author Lindelmo Havallon
     * @param Resquest  $request
     * @return boolean - Retorna se o usuario foi desativado com sucesso.
     */

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
