<?php

namespace App\Http\Controllers;

class EventoController extends Controller{
    
    public function __construct()
    {
        //
    }
    public function index()
    {
        return 'index';
    }
    public function cadastro()
    {
        return 'cadastro';
    }
    public function gerenciamento()
    {
        return 'gerenciamento';
    }
    public function editar($idevento)
    {
        return 'editar'.$idevento;
    }
    public function excluir($idevento)
    {
        return 'excluir'.$idevento;
    }
    public function visualizar($idevento)
    {
        return 'visualizar'.$idevento;
    }
    
    
    
}