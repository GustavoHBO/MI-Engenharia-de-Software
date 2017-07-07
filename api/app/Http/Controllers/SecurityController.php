<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SecurityController extends Controller
{
    //Método para evitar SQL INJECTION
    public function addbarras ($request){
        $array = $request->all();

        $array = array_map(function ($value){
            $value = addslashes($value);
            return $value;
        }, $array);
        return $array;
    }
}
