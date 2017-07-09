<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\SecurityController;

class PesquisaController extends Controller
{

     //Método para cadastrar item em relatorio
     public function novo(Request $request){

         $security = new SecurityController;
         $dados =  $security->addbarras($request);

         return response()->json($dados);

         $add = true;

        //  $add = DB::INSERT('INSERT INTO usuario (id_usuario, nome, sobrenome, tipo) VALUES (?, ?, ?, ?)',
        //  [$dados['id'], $dados['nome'], $dados['sobrenome'], 'f']);

         if ($add){
             return response()->json(true);
         } else {
             return response()->json(false);
         }

     }

     //Método para cadastrar item em relatorio
     public function get($datainicial, $datafinal){

        return response()->json($datafinal);

        $add = true;

        //  $add = DB::INSERT('INSERT INTO usuario (id_usuario, nome, sobrenome, tipo) VALUES (?, ?, ?, ?)',
        //  [$dados['id'], $dados['nome'], $dados['sobrenome'], 'f']);

         if ($add){
             return response()->json(true);
         } else {
             return response()->json(false);
         }

     }
}
