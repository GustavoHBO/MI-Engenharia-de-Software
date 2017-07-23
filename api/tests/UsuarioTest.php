<?php

use Laravel\Lumen\Testing\DatabaseMigrations;
use Laravel\Lumen\Testing\DatabaseTransactions;

class UsuarioTest extends TestCase
{
  
    public function testReadUser()
    {
        $this->json('GET', '/usr/abc123')->seeJson(
            ['nome'     => "teste",
            'sobrenome' => 'testando',]
            );
    }

    public function testCreateUser(){
        $this->json('POST', '/usr/new', 
        ['id'        => 'abc123',
         'nome'      => 'teste',
         'sobrenome' => 'testando']
        )->seeJson([true]);
    }

    public function testUpdateUser(){
        $this->json('POST', '/usr/update', 
        ['id'        => 'abc123',
         'nome'      => 'teste',
         'sobrenome' => 'testando']
        )->seeJson([false]);
    }

    public function testUpdateUser2(){
        $this->json('POST', '/usr/update', 
        ['id'        => 'abc123',
         'nome'      => 'teste',
         'sobrenome' => 'testa']
        )->seeJson([true]);
    }

    public function testDesativarUser(){
        $this->json('POST', '/usr/desativar', 
        ['id'        => 'abc123',]
        )->seeJson([true]);
    }
}
