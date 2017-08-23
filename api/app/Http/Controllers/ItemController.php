<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Http\Controllers\RelatorioController;

class ItemController extends Controller
{
    protected $controllerRelatorio;

    public function __construct()
    {
        $this->relatorioController = new RelatorioController;
    }
    
    /** 
     * MÉTODO QUE RETORNA TODOS OS DADOS DE TODOS ITENS
     * @author Gabriel Gomes
     * @return todos itens cadastrados
     */  
    public function todosItens(){
        $busca = DB::SELECT('SELECT * FROM casadosertao.item');
        
        
        return response()->json($busca);
    }
    
    /**
     * MÉTODO RETORNA TODOS OS ITENS ATIVOS
     * @author Gabriel Gomes
     * @return todos itens ativos
     */
    public function todosItensAtivos(){
        $busca = DB::SELECT('SELECT * FROM item it, aquisicao_item aq_it, caracteristicas_estilisticas_item carac_est_it, dimensao_item dim_it,documentacao_fotografica_item doc_fot_it WHERE it.id_item = aq_it.Item_id_item AND it.id_item = carac_est_it.Item_id_item AND it.id_item = dim_it.Item_id_item AND it.id_item = doc_fot_it.Item_id_item AND it.ativo = 1 ORDER BY it.id_item');
        
        foreach($busca as $b){
            $imagens = DB::SELECT('SELECT foto_url FROM item_imagem WHERE Item_id_item = ?',[$b->id_item]);
            $b->foto_imagem = $imagens;
        }
        return response()->json($busca);
    }
    /**
     * MÉTODO RETORNA TODOS OS ITENS ATIVOS POR FAIXA
     * @author Gabriel Gomes
     * @param número para faixa de valores
     * @return todos itens ativos por faixa de valores
     */
    public function todosItensAtivosPorFaixa($faixa){
        $busca = DB::SELECT('SELECT * FROM item it, aquisicao_item aq_it, caracteristicas_estilisticas_item carac_est_it, dimensao_item dim_it,documentacao_fotografica_item doc_fot_it WHERE it.id_item = aq_it.Item_id_item AND it.id_item = carac_est_it.Item_id_item AND it.id_item = dim_it.Item_id_item AND it.id_item = doc_fot_it.Item_id_item AND it.ativo = 1 ORDER BY it.id_item');
        
        foreach($busca as $b){
            $imagens = DB::SELECT('SELECT foto_url FROM item_imagem WHERE Item_id_item = ?',[$b->id_item]);
            $b->foto_imagem = $imagens;
        }
        
        if($faixa >= 0){
            $faixa = $faixa * 12;
            $valores = null;
            for($i = 0;$i < 12; $i++){
                if(array_key_exists($faixa + $i, $busca))
                    $valores[$i] = $busca[$faixa + $i];
                    
            }
            if($valores == null)
                return response()->json(false);

            return response()->json($valores);
        }else{
            return response()->json(false);
        }
        
    }    
    /**
     * MÉTODO RETORNA O NÚMERO DE ITENS
     * @author Gabriel Gomes
     * @return número de itens
     */
    public function numeroDeItensAtivos(){
        $valor = DB::SELECT('SELECT COUNT(id_item) FROM item WHERE ativo = 1');

         return response()->json($valor);
    }
    /**
     * MÉTODO BUSCAR ITEM PELO ID
     * @author Gabriel Gomes
     * @param id
     * @return item
     */
    public function buscarItem($id){
        $busca = DB::SELECT('SELECT * FROM item it, aquisicao_item aq_it, caracteristicas_estilisticas_item carac_est_it, dimensao_item dim_it,documentacao_fotografica_item doc_fot_it WHERE id_item = ? AND aq_it.Item_id_item = ? AND carac_est_it.Item_id_item = ? AND dim_it.Item_id_item = ? AND doc_fot_it.Item_id_item = ?',
        [$id,$id,$id,$id,$id]);

        if ($busca == null)
            return response()->json(false);
        
        $busca = $busca[0];

        $imagens = DB::SELECT('SELECT foto_url FROM item_imagem WHERE Item_id_item = ?',[$busca->id_item]);
        $busca->foto_imagem = $imagens;
        return response()->json($busca);
    }
    /**
     * MÉTODO PESQUISAR ITEM PELO TITULO OBS: só retornar os dados da tabela "item"
     * @author Gabriel Gomes
     * @param titulo
     * @return item
     */
    public function pesquisarItem($titulo){
        $busca = DB::SELECT('SELECT * FROM item WHERE titulo LIKE  ? ORDER BY titulo',
        ["%".$titulo."%"]);
        if ($busca == null)
            return response()->json(false);
        
        $busca = $busca;
        return response()->json($busca);
    }
    /**
     * MÉTODO CADASTRO DE ITEM
     * @author Gabriel Gomes
     * @param Request
     * @return boolean, retorna se o item foi cadastrado
     */
    public function cadastroItem(Request $request){
        $dados = $request->all();
        
        $add = DB::INSERT('INSERT INTO item (material, doador, funcao, procedencia, autor, origem, conservacao, colecao, categoria, classificacao, titulo,imagem_3d, estado_de_conservacao, iconologia, referencias_bibliograficas, descricao_objeto, local, data, historico, ativo) VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)',
        [$dados['material'],$dados['doador'], $dados['funcao'], $dados['procedencia'], $dados['autor'], $dados['origem'], $dados['conservacao'], $dados['colecao'], $dados['categoria'], $dados['classificacao'],$dados['titulo'],$dados['imagem_3d'], $dados['estado_de_conservacao'], $dados['iconologia'],$dados['referencias_bibliograficas'],$dados['descricao_objeto'],$dados['local'],$dados['data'], $dados['historico'], 1]);


        $id = DB::SELECT('SELECT id_item FROM item WHERE material = ? AND doador = ? AND funcao = ? AND procedencia = ? AND autor = ? AND origem = ? AND conservacao = ? AND colecao = ? AND categoria = ? AND classificacao = ? AND titulo = ? AND imagem_3d = ? AND estado_de_conservacao = ? AND iconologia = ? AND referencias_bibliograficas = ? AND descricao_objeto = ? AND local = ? AND data = ? AND historico = ? AND ativo',[$dados['material'],$dados['doador'], $dados['funcao'], $dados['procedencia'], $dados['autor'], $dados['origem'], $dados['conservacao'], $dados['colecao'], $dados['categoria'], $dados['classificacao'],$dados['titulo'],$dados['imagem_3d'], $dados['estado_de_conservacao'], $dados['iconologia'],$dados['referencias_bibliograficas'],$dados['descricao_objeto'],$dados['local'],$dados['data'], $dados['historico'], 1]);

        $add = DB::INSERT('INSERT INTO aquisicao_item (Item_id_item, data, modo_aquisicao, autor, observacao) VALUES (?,?,?,?,?)',
        [$id[0]->id_item, $dados['data_aquisicao'],$dados['modo_aquisicao'], $dados['autor_aquisicao'], $dados['observacao_aquisicao']]);

        

        $add = DB::INSERT('INSERT INTO caracteristicas_estilisticas_item (Item_id_item, materiais_constitutivos, tecnica_fabricacao, autoria) VALUES (?,?,?,?)',
        [$id[0]->id_item,$dados['materiais_cat_estilisticas'],$dados['tecnica_cat_estilisticas'], $dados['autoria_cat_estilisticas']]);

        $add = DB::INSERT('INSERT INTO dimensao_item (Item_id_item, altura, diamentro, largura, peso, comprimento) VALUES (?,?,?,?,?,?)',
        [$id[0]->id_item,$dados['altura_dimensao'],$dados['diametro_dimensao'],$dados['largura_dimensao'], $dados['peso_dimensao'], $dados['comprimento_dimensao']]);

        $add = DB::INSERT('INSERT INTO documentacao_fotografica_item (Item_id_item, fotografo, data, foto_url) VALUES (?,?,?,?)',
        [$id[0]->id_item,$dados['fotografo_doc_fotografica'],$dados['data_doc_fotografica'], $dados['foto_doc_fotografica']]);
        

        foreach($dados['foto_imagem'] as $f){
            $add = DB::INSERT('INSERT INTO item_imagem (Item_id_item, foto_url) VALUES (?,?)', [$id[0]->id_item, $f]);
        }

        if  ($add){
            //$relatorioController->criarItem($dados['id_item'],$dados['id_usr']);
            return response()->json(true);
        } else {
            return response()->json(false);
        }
    }
    /**
     * MÉTODO EDITAR ITEM
     * @author Gabriel Gomes
     * @param Request
     * @return boolean, retorna se o item foi alterado
     */
    public function editarItem (Request $request){
        $dados = $request->all();

        $update = DB::UPDATE('UPDATE item SET material = ?, doador = ?, funcao = ?, procedencia = ?, autor = ?, origem = ?, conservacao = ?, colecao = ?, categoria = ?, classificacao = ?, titulo = ?,imagem_3d =?, estado_de_conservacao = ?, iconologia = ?, referencias_bibliograficas = ?, descricao_objeto = ?, local = ?, data = ?, historico = ? WHERE id_item = ?',
        [$dados['material'],$dados['doador'], $dados['funcao'], $dados['procedencia'], $dados['autor'], $dados['origem'], $dados['conservacao'], $dados['colecao'], $dados['categoria'], $dados['classificacao'],$dados['titulo'],$dados['imagem_3d'], $dados['estado_de_conservacao'], $dados['iconologia'],$dados['referencias_bibliograficas'],$dados['descricao_objeto'],$dados['local'],$dados['data'], $dados['historico'], $dados['id_item']]);

        $update = DB::UPDATE('UPDATE aquisicao_item SET data = ?, modo_aquisicao = ?, autor = ?, observacao = ? WHERE Item_id_item = ?',
        [$dados['data_aquisicao'],$dados['modo_aquisicao'], $dados['autor_aquisicao'], $dados['observacao_aquisicao'],$dados['id_item']]);

        $update = DB::UPDATE('UPDATE caracteristicas_estilisticas_item SET materiais_constitutivos = ?, tecnica_fabricacao = ?, autoria = ? WHERE Item_id_item = ?',
        [$dados['materiais_cat_estilisticas'],$dados['tecnica_cat_estilisticas'], $dados['autoria_cat_estilisticas'],$dados['id_item']]);

        $update = DB::UPDATE('UPDATE dimensao_item SET altura = ?, diamentro = ?, largura = ?, peso = ?, comprimento = ? WHERE Item_id_item = ?',
        [$dados['altura_dimensao'],$dados['diametro_dimensao'],$dados['largura_dimensao'], $dados['peso_dimensao'], $dados['comprimento_dimensao'],$dados['id_item']]);

        $update = DB::UPDATE('UPDATE documentacao_fotografica_item SET fotografo = ?, data = ?, foto_url = ? WHERE Item_id_item = ?',
        [$dados['fotografo_doc_fotografica'],$dados['data_doc_fotografica'], $dados['foto_doc_fotografica'],$dados['id_item']]);

        foreach($dados['foto_imagem'] as $f){
            $update = DB::UPDATE('UPDATE item_imagem SET foto_url = ? WHERE Item_id_item = ?', [$f,$dados['id_item']]);
        }

        if  ($update){
            //$relatorioController->editaItem($dados['id_item'],$dados['id_usr']);
            return response()->json(true);
        } else {
            return response()->json(false);
        }

    }
    /**
     * MÉTODO DESATIVA ITEM
     * @author Gabriel Gomes
     * @param Request
     * @return boolean, retorna se o item foi desativado
     */
    public function desativaItem (Request $request){
        $dados = $request->all();

        $desativa = DB::UPDATE('UPDATE item SET ativo = 0 WHERE id_item = ?',[$dados['id_item']]);

        if  ($desativa){
            return response()->json(true);
        } else {
            return response()->json(false);
        }
    }
    /**
     * MÉTODO ATIVA ITEM
     * @author Gabriel Gomes
     * @param Request
     * @return boolean, retorna se o item foi ativado
     */
    public function ativaItem (Request $request){
        $dados = $request->all();

        $ativa = DB::UPDATE('UPDATE item SET ativo = 1 WHERE id_item = ?',[$dados['id_item']]);

        if  ($ativa){
            return response()->json(true);
        } else {
            return response()->json(false);
        }
    }
    /**
     * MÉTODO FAVORITA ITEM
     * @author Gabriel Gomes
     * @param Request
     * @return boolean, retorna se o item foi favoritado
     */
    public function favoritaItem(Request $request){
        $dados = $request->all();

        $busca = DB::SELECT('SELECT favorita_item.Item_id_item, favorita_item.Usuario_id_usuario FROM favorita_item WHERE favorita_item.Item_id_item = ? AND favorita_item.Usuario_id_usuario = ?',
        [$dados['Item_id_item'],$dados['Usuario_id_usuario']]);

        if ($busca != null)
            return response()->json(false);

        $add = DB::INSERT('INSERT INTO favorita_item (Item_id_item, Usuario_id_usuario) VALUES (?, ?)',
        [$dados['Item_id_item'], $dados['Usuario_id_usuario']]);

        if  ($add){
            return response()->json(true);
        } else {
            return response()->json(false);
        }
    }
   
    /**
     * MÉTODO RETORNA TODOS ITENS FAVORITOS
     * @author Gabriel Gomes
     * @param id do usuario
     * @return retorna todos itens favoritados por um usuário
     */
    public function todosItensFavoritos($id_usuario){
        $busca = DB::SELECT('SELECT id_item, it.material, it.doador, it.funcao, it.procedencia, it.autor, it.origem, it.conservacao, it.colecao, it.categoria, it.classificacao, it.titulo, it.imagem_3d, it.estado_de_conservacao, it.iconologia, it.referencias_bibliograficas, it.descricao_objeto, it.local, it.data, it.historico FROM favorita_item fi INNER JOIN item it ON fi.Item_id_item = it.id_item INNER JOIN usuario usr ON usr.id_usuario = ?',[$id_usuario]);
        
        if ($busca == null)
            return response()->json(false);
        
        return response()->json($busca);
    }
    /**
     * MÉTODO REMOVE FAVORITO
     * @author Gabriel Gomes
     * @param Request
     * @return boolean, se o item foi removido dos favoritos
     */
    public function removerFavorito (Request $request){
        $dados = $request->all();

        $delete = DB::DELETE('DELETE FROM favorita_item WHERE favorita_item.Item_id_item = ? AND favorita_item.Usuario_id_usuario = ?', [$dados['id_item'],$dados['id_usuario']]);

        if  ($delete){
            return response()->json(true);
        } else {
            return response()->json(false);
        }

    }

  
    

    

}
