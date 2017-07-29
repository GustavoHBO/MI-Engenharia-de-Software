<?php

use Laravel\Lumen\Testing\DatabaseMigrations;
use Laravel\Lumen\Testing\DatabaseTransactions;

class FuncionarioTest extends TestCase
{
  
    public function testReadUser()
    {
        $this->json('GET', '/func/abc123')->seeJson(
            ['nome'     => "teste",
            'sobrenome' => 'testando',]
            );
    }

    public function testCreateUser(){
        $this->json('POST', '/func/new', 
        ['id'        => 'abc123',
         'nome'      => 'teste',
         'sobrenome' => 'testando',
         'gerenciar_itens' => false,
         'gerenciar_eventos' => true,
         'gerenciar_noticias' => false]
        )->seeJson([true]);
    }

    public function testUpdateUser(){
        $this->json('POST', '/func/update', 
        ['id'        => 'abc123',
         'nome'      => 'teste',
         'sobrenome' => 'testando',
         'gerenciar_itens' => false,
         'gerenciar_eventos' => true,
         'gerenciar_noticias' => false]
        )->seeJson([false]);
    }

    public function testUpdateUser2(){
        $this->json('POST', '/func/update', 
        ['id'        => 'abc123',
         'nome'      => 'teste',
         'sobrenome' => 'testa',
         'gerenciar_itens' => false,
         'gerenciar_eventos' => true,
         'gerenciar_noticias' => true]
        )->seeJson([true]);
    }

    public function testDesativarUser(){
        $this->json('POST', '/func/desativar', 
        ['id'        => 'abc123',]
        )->seeJson([true]);
    }
}
