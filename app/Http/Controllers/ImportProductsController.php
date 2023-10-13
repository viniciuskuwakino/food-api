<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use ZipArchive;


function imprime(array $obj): void
{
    echo "code: " . $obj['code'] . "<br>";
    // echo "status: " . $obj['status'];
    // echo "imported_t: " . $obj['imported_t'];
    echo "url: " . $obj['url'] . "<br>";
    echo "creator: " . $obj['creator'] . "<br>";
    echo "created_t: " . $obj['created_t'] . "<br>";
    echo "last_modified_t: " . $obj['last_modified_t'] . "<br>";
    echo "product_name: " . $obj['product_name'] . "<br>";
    echo "quantity: " . $obj['quantity'] . "<br>";
    echo "brands: " . $obj['brands'] . "<br>";
    echo "categories: " . $obj['categories'] . "<br>";
    echo "labels: " . $obj['labels'] . "<br>";
    echo "cities: " . $obj['cities'] . "<br>";
    echo "purchase_places: " . $obj['purchase_places'] . "<br>";
    echo "stores: " . $obj['stores'] . "<br>";
    echo "ingredients_text: " . $obj['ingredients_text'] . "<br>";
    echo "traces: " . $obj['traces'] . "<br>";
    echo "serving_size: " . $obj['serving_size'] . "<br>";
    echo "serving_quantity: " . $obj['serving_quantity'] . "<br>";
    echo "nutriscore_score: " . $obj['nutriscore_score'] . "<br>";
    echo "nutriscore_grade: " . $obj['nutriscore_grade'] . "<br>";
    echo "main_category: " . $obj['main_category'] . "<br>";
    echo "image_url: " . $obj['image_url'] . "<br>";
}


class ImportProductsController extends Controller
{

    
    public function populate()
    {
//      This input should be from somewhere else, hard-coded in this example
        $fileName = 'products_01.json.gz';
        $zipTemporario = storage_path("/temporario.gz");
        $unZipTemporario = storage_path("/data.json");

        $response = Http::get("https://challenges.coode.sh/food/data/json/{$fileName}");
//        $response = Http::get("https://challenges.coode.sh/food/data/json/index.txt");
//        dd($response->body());
        file_put_contents($zipTemporario, $response->body());

        $file = gzopen($zipTemporario, 'rb');
        $outFile = fopen($unZipTemporario, 'wb');

        while (!gzeof($file)) {
            fwrite($outFile, gzread($file, 4096));
        }

        gzclose($file);
        fclose($outFile);


        $json_data = fopen($unZipTemporario, 'r');
        $cont = 0;
        if ($json_data) {
            while (($line = fgets($json_data)) !== false && $cont < 100) {
                $line = trim($line);

                $jsonObject = json_decode($line, true);

                imprime($jsonObject);
                $cont++;
            }
        }

        fclose($json_data);

        unlink($zipTemporario);
        unlink($unZipTemporario);

        //        return $response->body();
//        $response->json();
//        dd($lista);
    }

}
