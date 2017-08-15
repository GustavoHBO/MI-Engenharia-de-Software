<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\SecurityController;

class RelatorioController extends Controller
{

     //Método para cadastrar item em relatorio
     public function get($datainicial, $datafinal) {

       $relatorios = DB::select("select e.data, u.nome, 'criou evento' as descricao, i.titulo from cria_evento e left join evento i on (e.Evento_id_evento = i.id_evento) left join usuario u on (e.Usuario_id_usuario = u.id_usuario) WHERE e.data BETWEEN ? AND ? union
       select e.data, u.nome, 'criou exposição' as descricao, i.titulo from cria_exposicao e left join exposicao i on (e.Exposicao_id_exposicao = i.id_exposicao) left join usuario u on (e.Usuario_id_usuario = u.id_usuario) WHERE e.data BETWEEN ? AND ? union
       select e.data, u.nome, 'adicionou item' as descricao, i.titulo from cria_item e left join item i on (e.Item_id_item = i.id_item) left join usuario u on (e.Usuario_id_usuario = u.id_usuario) WHERE e.data BETWEEN ? AND ? union
       select e.data, u.nome, 'editou evento' as descricao, i.titulo from edita_evento e left join evento i on (e.Evento_id_evento = i.id_evento) left join usuario u on (e.Usuario_id_usuario = u.id_usuario) WHERE e.data BETWEEN ? AND ? union
       select e.data, u.nome, 'editou exposição' as descricao, i.titulo from edita_exposicao e left join exposicao i on (e.Exposicao_id_exposicao = i.id_exposicao) left join usuario u on (e.Usuario_id_usuario = u.id_usuario) WHERE e.data BETWEEN ? AND ? union
       select e.data, u.nome, 'editou item' as descricao, i.titulo from edita_item e left join item i on (e.Item_id_item = i.id_item) left join usuario u on (e.Usuario_id_usuario = u.id_usuario) WHERE e.data BETWEEN ? AND ? union
       select e.data, u.nome, 'editou notícia' as descricao, i.titulo from editar_noticia e left join noticia i on (e.Noticia_id_noticia = i.id_noticia) left join usuario u on (e.Usuario_id_user = u.id_usuario) WHERE e.data BETWEEN ? AND ? union
       select e.data, u.nome, 'removeu evento' as descricao, i.titulo from remove_evento e left join evento i on (e.Evento_id_evento = i.id_evento) left join usuario u on (e.Usuario_id_usuario = u.id_usuario) WHERE e.data BETWEEN ? AND ? union
       select e.data, u.nome, 'removeu exposição' as descricao, i.titulo from remove_exposicao e left join exposicao i on (e.Exposicao_id_exposicao = i.id_exposicao) left join usuario u on (e.Usuario_id_usuario = u.id_usuario) WHERE e.data BETWEEN ? AND ? union
       select e.data, u.nome, 'removeu item' as descricao, i.titulo from remove_item e left join item i on (e.Item_id_item = i.id_item) left join usuario u on (e.Usuario_id_usuario = u.id_usuario) WHERE e.data BETWEEN ? AND ? union
       select e.data, u.nome, 'removeu notícia' as descricao, i.titulo from remove_noticia e left join noticia i on (e.Noticia_id_noticia = i.id_noticia) left join usuario u on (e.Usuario_id_user = u.id_usuario) WHERE e.data BETWEEN ? AND ? union
       select e.data, u.nome, 'desabilitou pesquisa' as descricao, i.titulo from desabilita_pesquisa e left join pesquisa i on (e.Pesquisa_id_pesquisa = i.id_pesquisa) left join usuario u on (e.Usuario_id_usuario = u.id_usuario) WHERE e.data BETWEEN ? AND ?
       ", [$datainicial, $datafinal,$datainicial, $datafinal,$datainicial, $datafinal,$datainicial, $datafinal,$datainicial, $datafinal,$datainicial, $datafinal,$datainicial, $datafinal,$datainicial, $datafinal,$datainicial, $datafinal,$datainicial, $datafinal,$datainicial, $datafinal,$datainicial, $datafinal]);

       return response()->json($relatorios);

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
