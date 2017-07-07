<?php

namespace App\Http\Controllers;

use Laravel\Lumen\Routing\Controller as BaseController;

class NoticiaController extends BaseController
{
    public function __construct(){

	}

	public function buscarNoticia($id_buscar){
		return "busquei a noticia: " .$id_buscar;
	}

	public function exibirNoticia($id_exibir){
		return "exibir a noticia: " .$id_exibir;
	}

	public function compartilharNoticia($id_exibir){
		return "compartilhar a noticia: " .$id_exibir;
	}

	public function telaInicialNoticia(){
		return "Tela Inicial";
	}

 	public function addTask($id_buscar){
       return $id_buscar;
       //return view('task/principal');
    }

    public function listarNoticia(){
    	return "Estou dentro do método listar";

    }

    public function excluirNoticia

}
