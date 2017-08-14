<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SecurityController extends Controller
{
    //Método para evitar SQL INJECTION
    /**
     * Método para evitar o SQL INJECTION colocando as \ antes dos caracters reservardos do SGBD.
     * @author Lindelmo Havallon
     * @param Array $request
     * @return response - Retorna um vetor com as barras adicionadas.
     */
    public function addbarras ($request){
        $array = $request->all();

        $array = array_map(function ($value){
            $value = addslashes($value);
            return $value;
        }, $array);
        return $array;
    }
}
