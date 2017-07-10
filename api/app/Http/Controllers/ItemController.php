<?php

namespace App\Http\Controllers;

class ItemController extends Controller
{

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
    public function editar($iditem)
    {
        return 'editar'.$iditem;
    }
    public function listar()
    {
        return 'listar';
    }
    public function listarFavoritos()
    {
        return 'listar favoritos';
    }
    public function visualizar($iditem)
    {
        return 'visualizar'.$iditem;
    }
   
}
