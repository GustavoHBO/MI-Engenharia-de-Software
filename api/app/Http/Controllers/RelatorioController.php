<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\SecurityController;

class RelatorioController extends Controller
{

     //Método para cadastrar item em relatorio
     public function novo() {

      //  return response()->json($this->criarEvento(1, 1));
      //  return response()->json($this->criarExposicao(1, 1));
      // return response()->json($this->criarItem(1, 1));
      // return response()->json($this->desabilitaPesquisa(1, 2));
      // return response()->json($this->editaEvento(1, 2));
      // return response()->json($this->editaExposicao(1, 2));
      // return response()->json($this->editaItem(1, 2));
      // return response()->json($this->editaNoticia(1, 2));
      // return response()->json($this->removeEvento(1, 2));
      // return response()->json($this->removeExposicao(2, 3));
      // return response()->json($this->removeItem(2, 3));
      //  return response()->json($this->removeNoticia(2, 3));

     }

     //Método que cadastra log de criação de evento
     public function criarEvento($idEvento, $idUsuario){

       $data = date("Y-m-d H:i:s");

       $insert = DB::insert("insert into cria_evento values(?, ?, ?)", [$data, $idEvento, $idUsuario]);

       return $insert;

     }

     //Método que cadastra log de criação de exposicao
     public function criarExposicao($idExposicao, $idUsuario){

       $data = date("Y-m-d H:i:s");

       $insert = DB::insert("insert into cria_exposicao values(?, ?, ?)", [$data, $idExposicao, $idUsuario]);

       return $insert;

     }

     //Método que cadastra log de criação de item
     public function criarItem($idItem, $idUsuario){

       $data = date("Y-m-d H:i:s");

       $insert = DB::insert("insert into cria_item values(?, ?, ?)", [$data, $idItem, $idUsuario]);

       return $insert;

     }

     //Método que cadastra log de edição de evento
     public function editaEvento($idEvento, $idUsuario){

       $data = date("Y-m-d H:i:s");

       $insert = DB::insert("insert into edita_evento values(?, ?, ?)", [$data, $idEvento, $idUsuario]);

       return $insert;

     }

     //Método que cadastra log de edição de exposição
     public function editaExposicao($idExposicao, $idUsuario){

       $data = date("Y-m-d H:i:s");

       $insert = DB::insert("insert into edita_exposicao values(?, ?, ?)", [$data, $idExposicao, $idUsuario]);

       return $insert;

     }

     //Método que cadastra log de edição de item
     public function editaItem($idItem, $idUsuario){

       $data = date("Y-m-d H:i:s");

       $insert = DB::insert("insert into edita_item values(?, ?, ?)", [$data, $idItem, $idUsuario]);

       return $insert;

     }

     //Método que cadastra log de edição de noticia
     public function editaNoticia($idNoticia, $idUsuario){

       $data = date("Y-m-d H:i:s");

       $insert = DB::insert("insert into editar_noticia values(?, ?, ?)", [$data, $idNoticia, $idUsuario]);

       return $insert;

     }

     //Método que cadastra log de remover evento
     public function removeEvento($idEvento, $idUsuario){

       $data = date("Y-m-d H:i:s");

       $insert = DB::insert("insert into remove_evento values(?, ?, ?)", [$data, $idEvento, $idUsuario]);

       return $insert;

     }

     //Método que cadastra log de remover exposicao
     public function removeExposicao($idExposicao, $idUsuario){

       $data = date("Y-m-d H:i:s");

       $insert = DB::insert("insert into remove_exposicao values(?, ?, ?)", [$data, $idExposicao, $idUsuario]);

       return $insert;

     }

     //Método que cadastra log de remover item
     public function removeItem($idItem, $idUsuario){

       $data = date("Y-m-d H:i:s");

       $insert = DB::insert("insert into remove_item values(?, ?, ?)", [$data, $idItem, $idUsuario]);

       return $insert;

     }

     //Método que cadastra log de remover noticia
     public function removeNoticia($idNoticia, $idUsuario){

       $data = date("Y-m-d H:i:s");

       $insert = DB::insert("insert into remove_noticia values(?, ?, ?)", [$data, $idNoticia, $idUsuario]);

       return $insert;

     }

     //Método que cadastra log de desabilitar item
     public function desabilitaPesquisa($idPesquisa, $idUsuario){

       $data = date("Y-m-d H:i:s");

       $insert = DB::insert("insert into desabilita_pesquisa values(?, ?, ?)", [$data, $idUsuario, $idPesquisa]);

       return $insert;

     }
}
