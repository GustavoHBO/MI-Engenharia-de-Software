<?php

namespace App\Http\Controllers;

use Laravel\Lumen\Routing\Controller as BaseController;

class ExposicaoController extends BaseController
{
	public function __construct(){

	}


	public function buscarExposicao($idexposicao){
		return "exposicao buscada: " .$idexposicao;
	}

	public function telaIncialExposicao(){
		return "Tela Inicial Exposicao";
	}


}