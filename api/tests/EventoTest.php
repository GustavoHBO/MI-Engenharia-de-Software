<?php

use Laravel\Lumen\Testing\DatabaseMigrations;
use Laravel\Lumen\Testing\DatabaseTransactions;

class EventoTest extends TestCase {

    public function criarEvento(){
        $this->json('POST', '/evento/cadastrar', 
        ['titulo' => 'tit',
        'local' => 'loc',
        'responsavel' => 'resp',
        'foto_url' => 'fot', 
        'artista' => 'art', 
        'horario_visitacao' => 'hrr', 
        'data_inicio' => 'datini', 
        'data_fim' => 'datfim', 
        'categoria' => 'cat'
        ]
        )->seeJson([true]);
    }

    public function buscarEvento()
    {
        $this->json('GET', '/evento/1')->seeJson(
            ['titulo' => 'tit',
            'local' => 'loc',
            'responsavel' => 'resp',
            'foto_url' => 'fot', 
            'artista' => 'art', 
            'horario_visitacao' => 'hrr', 
            'data_inicio' => 'datini', 
            'data_fim' => 'datfim', 
            'categoria' => 'cat',
            'ativo' => '1']
        );
    }

    public function pesquisarEvento()
    {
        $this->json('GET', '/evento/tit')->seeJson(
            ['titulo' => 'tit',
            'local' => 'loc',
            'responsavel' => 'resp',
            'foto_url' => 'fot', 
            'artista' => 'art', 
            'horario_visitacao' => 'hrr', 
            'data_inicio' => 'datini', 
            'data_fim' => 'datfim', 
            'categoria' => 'cat',
            'ativo' => '1']
        );
    }

    public function editarEvento(){
        $this->json('POST', '/evento/cadastrar', 
        ['titulo' => 'titttttttt',
        'local' => 'loc',
        'responsavel' => 'resp',
        'foto_url' => 'fot', 
        'artista' => 'art', 
        'horario_visitacao' => 'hrr', 
        'data_inicio' => 'datini', 
        'data_fim' => 'datfim', 
        'categoria' => 'cat',
        'ativo' => '1']
        )->seeJson([true]);
    }

    public function desativaEvento(){
        $this->json('POST', '/evento/desativa', 
        ['id_evento'        => '1',
        'id_usuario'        => '1']
        )->seeJson([true]);
    }

    public function ativaEvento(){
        $this->json('POST', '/evento/ativa', 
        ['id_evento'        => '1',
        'id_usuario'        => '1']
        )->seeJson([true]);
    }
    public function favoritaEvento(){
        $this->json('POST', '/evento/favoritos/add', 
        ['id_evento'        => '1',
        'id_usuario'        => '1']
        )->seeJson([true]);
    }
     public function desfavoritaEvento(){
        $this->json('POST', '/evento/favoritos/remover', 
        ['id_evento'        => '1',
        'id_usuario'        => '1']
        )->seeJson([true]);
    }

}