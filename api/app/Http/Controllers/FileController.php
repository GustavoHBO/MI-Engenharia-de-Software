<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FileController extends Controller
{

    public function readAll(){
        $dir = new \DirectoryIterator('export');
        $files = array();
        foreach($dir as $f){
            if ($f->isFile()){
                $nome = str_replace(".txt", "", $f->getFileName());
                $size = $f->getSize();
                $size = $size / 1024;
                $files[] = array("nome" => $nome, "size" => $size . ' KB');
            }
        }
        return response()->json($files);
    }

    public function delete(Request $request){
        $nome = $request->input('nome');
        unlink("export" . "/" . $nome . ".txt");
        return response()->json(true);
    }

}
