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
         'permissoes'=> array(1,3)]
        )->seeJson([true]);
    }

    public function testUpdateUser(){
        $this->json('POST', '/func/update', 
        ['id'        => 'abc123',
         'nome'      => 'teste',
         'sobrenome' => 'testando',
         'permissoes'=> array(1,3)]
        )->seeJson([false]);
    }

    public function testUpdateUser2(){
        $this->json('POST', '/func/update', 
        ['id'        => 'abc123',
         'nome'      => 'teste',
         'sobrenome' => 'testa',
         'permissoes'=> array(1,2,3)]
        )->seeJson([true]);
    }

    public function testDesativarUser(){
        $this->json('POST', '/func/desativar', 
        ['id'        => 'abc123',]
        )->seeJson([true]);
    }
}
