<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\SecurityController;

class PesquisaController extends Controller
{

     //Método para cadastrar item em pesquisa
     public function cadastro(Request $request){

         $security = new SecurityController;
         $dados =  $security->addbarras($request);

        //  return response()->json($dados);

        //  $add = true;

         $add = DB::INSERT('INSERT INTO pesquisa (titulo, descricao, link, data, Usuario_id_usuario, ativo) VALUES (?, ?, ?, ?, ?, ?)',
         [$dados['titulo'], $dados['descricao'], $dados['link'], $dados['data'], $dados['Usuario_id_usuario'], 1]);

         if ($add){
             return response()->json(true);
         } else {
             return response()->json(false);
         }

     }

     // Método para retorna lista de pesquisas
     public function get(){

       $pesquisa = DB::SELECT('SELECT * FROM pesquisa');
       return response()->json($pesquisa);

     }
}
