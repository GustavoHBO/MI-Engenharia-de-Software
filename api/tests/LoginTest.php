<?php

use Laravel\Lumen\Testing\DatabaseMigrations;
use Laravel\Lumen\Testing\DatabaseTransactions;

class LoginTest extends TestCase
{
  
    public function testLogin()
    {
        $this->json('POST', '/login',
        ['id'       => "abc123",
        'nome'      => "teste",
        'sobrenome' => "testando"])->seeJson(
            ['ativo' => 0]
            );
    }
}
