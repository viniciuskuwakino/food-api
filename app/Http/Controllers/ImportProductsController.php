<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use ZipArchive;

class ImportProductsController extends Controller
{
    public function populate()
    {
//        dd(storage_path("/temp"));
        //This input should be from somewhere else, hard-coded in this example
        $fileName = 'products_01.json.gz';
        $zipTemporario = storage_path("/temp/temporario.gz");

        $response = Http::get("https://challenges.coode.sh/food/data/json/{$fileName}");
        file_put_contents($zipTemporario, $response->body());

        $file = gzopen($zipTemporario, 'rb');
        while (!gzeof($file)) {
            $teste = (string) json_encode(gzread($file, 4096));
            $dec = collect($teste);
            dd(json_decode($dec[0], true));
//            dd(gettype(json_decode(json_encode(gzread($file, 4096)), true)));
//            dd(json_decode(json_encode(gzread($file, 4096)), true));
//            return gzread($file, 20000);
        }
//        dd($file);
//        $zip = new ZipArchive;
//        dd($zip->open($zipTemporario));

//        try {
//            $zip->open($zipTemporario, ZipArchive::CREATE);
//            $extractPath = storage_path("/temp");
//            $zip->extractTo($extractPath);
//            $zip->close();
//        } catch (\Exception $e) {
//            echo $e->getMessage();
//        }


//        if ($zip->open($zipTemporario, ZipArchive::CREATE)) {
////        $zip->open($zipTemporario);
//            $extractPath = storage_path("/temp");
//
//            $zip->extractTo($extractPath);
//            $zip->close();
////            dd($extractPath);
//
//        } else {
//            echo 'Erro ao abrir o arquivo!';
//        }

//        unlink($zipTemporario);


//        return $response->body();
//        $response->json();
//        dd($lista);
    }
}
