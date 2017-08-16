<?php

use Laravel\Lumen\Testing\DatabaseMigrations;
use Laravel\Lumen\Testing\DatabaseTransactions;

class ItemTest extends TestCase {

    public function criarItem(){

        $this->json('POST', '/item', 
        ["material"=>"m5",
        "doador"=>"d5",
        "funcao"=>"f5",
        "procedencia"=>"p5",
        "autor"=>"a5",
        "origem"=>"o5",
        "conservacao"=>"c5",
        "colecao"=>"c5",
        "categoria"=>"c5",
        "classificacao"=>"c5",
        "titulo"=>"t5",
        "imagem_3d"=>"i35",
        "estado_de_conservacao"=>"ec5",
        "iconologia"=>"i5",
        "referencias_bibliograficas"=>"rb5",
        "descricao_objeto"=>"do5",
        "local"=>"l5",
        "data"=>"2004/04/05",
        "historico"=>"h5",
        "ativo"=>"1",
        "data_aquisicao"=>"2005/02/05",
        "modo_aquisicao"=>"mda5",
        "autor_aquisicao"=>"aut5",
        "observacao_aquisicao"=>"ob5",
        "materiais_cat_estilisticas"=>"matc5",
        "tecnica_cat_estilisticas"=>"tf5",
        "autoria_cat_estilisticas"=>"au5",
        "altura_dimensao"=>"55.555",
        "diametro_dimensao"=>"55.555",
        "largura_dimensao"=>"55.555",
        "peso_dimensao"=>"55.555",
        "comprimento_dimensao"=>"55.555",
        "fotografo_doc_fotografica"=>"fotografo5",
        "data_doc_fotografica"=>"2006/03/05",
        "foto_doc_fotografica"=>"docfotourl5",
        "foto_imagem[]"=>"fotourl5",
        "foto_imagem[]"=>"fotourl7"
    ]
        )->seeJson([true]);
    }

    public function buscarItem()
    {
        $this->json('GET', '/item/1')->seeJson(
            ["material"=>"m5",
            "doador"=>"d5",
            "funcao"=>"f5",
            "procedencia"=>"p5",
            "autor"=>"a5",
            "origem"=>"o5",
            "conservacao"=>"c5",
            "colecao"=>"c5",
            "categoria"=>"c5",
            "classificacao"=>"c5",
            "titulo"=>"t5",
            "imagem_3d"=>"i35",
            "estado_de_conservacao"=>"ec5",
            "iconologia"=>"i5",
            "referencias_bibliograficas"=>"rb5",
            "descricao_objeto"=>"do5",
            "local"=>"l5",
            "data"=>"2004/04/05",
            "historico"=>"h5",
            "ativo"=>"1",
            "data_aquisicao"=>"2005/02/05",
            "modo_aquisicao"=>"mda5",
            "autor_aquisicao"=>"aut5",
            "observacao_aquisicao"=>"ob5",
            "materiais_cat_estilisticas"=>"matc5",
            "tecnica_cat_estilisticas"=>"tf5",
            "autoria_cat_estilisticas"=>"au5",
            "altura_dimensao"=>"55.555",
            "diametro_dimensao"=>"55.555",
            "largura_dimensao"=>"55.555",
            "peso_dimensao"=>"55.555",
            "comprimento_dimensao"=>"55.555",
            "fotografo_doc_fotografica"=>"fotografo5",
            "data_doc_fotografica"=>"2006/03/05",
            "foto_doc_fotografica"=>"docfotourl5",
            "foto_imagem[]"=>"fotourl5",
            "foto_imagem[]"=>"fotourl7"
        ]
        );
    }

    public function pesquisarItem()
    {
        $this->json('GET', '/item/pesquisar/t5')->seeJson(
            ["material"=>"m5",
            "doador"=>"d5",
            "funcao"=>"f5",
            "procedencia"=>"p5",
            "autor"=>"a5",
            "origem"=>"o5",
            "conservacao"=>"c5",
            "colecao"=>"c5",
            "categoria"=>"c5",
            "classificacao"=>"c5",
            "titulo"=>"t5",
            "imagem_3d"=>"i35",
            "estado_de_conservacao"=>"ec5",
            "iconologia"=>"i5",
            "referencias_bibliograficas"=>"rb5",
            "descricao_objeto"=>"do5",
            "local"=>"l5",
            "data"=>"2004/04/05",
            "historico"=>"h5",
            "ativo"=>"1",
            "data_aquisicao"=>"2005/02/05",
            "modo_aquisicao"=>"mda5",
            "autor_aquisicao"=>"aut5",
            "observacao_aquisicao"=>"ob5",
            "materiais_cat_estilisticas"=>"matc5",
            "tecnica_cat_estilisticas"=>"tf5",
            "autoria_cat_estilisticas"=>"au5",
            "altura_dimensao"=>"55.555",
            "diametro_dimensao"=>"55.555",
            "largura_dimensao"=>"55.555",
            "peso_dimensao"=>"55.555",
            "comprimento_dimensao"=>"55.555",
            "fotografo_doc_fotografica"=>"fotografo5",
            "data_doc_fotografica"=>"2006/03/05",
            "foto_doc_fotografica"=>"docfotourl5",
            "foto_imagem[]"=>"fotourl5",
            "foto_imagem[]"=>"fotourl7"
        ]
        );
    }

    public function editarItem(){
        $this->json('POST', '/item/editar', 
        ["material"=>"m555555",
            "doador"=>"d5",
            "funcao"=>"f5",
            "procedencia"=>"p5",
            "autor"=>"a5",
            "origem"=>"o5",
            "conservacao"=>"c5",
            "colecao"=>"c5",
            "categoria"=>"c5",
            "classificacao"=>"c5",
            "titulo"=>"t5",
            "imagem_3d"=>"i35",
            "estado_de_conservacao"=>"ec5",
            "iconologia"=>"i5",
            "referencias_bibliograficas"=>"rb5",
            "descricao_objeto"=>"do5",
            "local"=>"l5",
            "data"=>"2004/04/05",
            "historico"=>"h5",
            "ativo"=>"1",
            "data_aquisicao"=>"2005/02/05",
            "modo_aquisicao"=>"mda5",
            "autor_aquisicao"=>"aut5",
            "observacao_aquisicao"=>"ob5",
            "materiais_cat_estilisticas"=>"matc5",
            "tecnica_cat_estilisticas"=>"tf5",
            "autoria_cat_estilisticas"=>"au5",
            "altura_dimensao"=>"55.555",
            "diametro_dimensao"=>"55.555",
            "largura_dimensao"=>"55.555",
            "peso_dimensao"=>"55.555",
            "comprimento_dimensao"=>"55.555",
            "fotografo_doc_fotografica"=>"fotografo5",
            "data_doc_fotografica"=>"2006/03/05",
            "foto_doc_fotografica"=>"docfotourl5",
            "foto_imagem[]"=>"fotourl5",
            "foto_imagem[]"=>"fotourl7"
        ]
        )->seeJson([true]);
    }

    public function desativaItem(){
        $this->json('POST', '/item/desativa', 
        ['id_item'        => '1',
        'id_usuario'        => '1']
        )->seeJson([true]);
    }
    public function ativaItem(){
        $this->json('POST', '/item/ativa', 
        ['id_item'        => '1',
        'id_usuario'        => '1']
        )->seeJson([true]);
    }

    public function favoritaItem(){
        $this->json('POST', '/item/favoritos/add', 
        ['id_evento'        => '1',
        'id_usuario'        => '1']
        )->seeJson([true]);
    }

    public function desfavoritaItem(){
        $this->json('POST', '/item/favoritos/remover', 
        ['id_evento'        => '1',
        'id_usuario'        => '1']
        )->seeJson([true]);
    }

}