<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FileController extends Controller
{
    /**
     * Método para exibir todos os backups feitos no sistema.
     * @author Lindelmo Havallon
     * @return response - Todos os backups.
     */
    public function readAll(){
        $dir = new \DirectoryIterator('export');
        $files = array();
        foreach($dir as $f){
            if ($f->isFile()){
                $nome = str_replace(".txt", "", $f->getFileName());
                $size = $f->getSize();
                $size = $size / 1024;
                $caminho = "https://museucasadosertao.000webhostapp.com/api/api/public/myBackup/export/" . $nome . ".sql";
                $files[] = array("nome" => $nome, "size" => $size . ' KB', "url" => $caminho);
            }
        }
        return response()->json($files);
    }

    /**
     * Método para deletar um backup especificos no sistema.
     * @author Lindelmo Havallon
     * @param Resquest $request
     * @return boolean - Se o arquivo foi deletado com sucesso.
     */

    public function delete(Request $request){
        $nome = $request->input('nome');
        unlink("export" . "/" . $nome . ".txt");
        return response()->json(true);
    }

}
