<?php

namespace App\Services;

use App\Models\ProductFile;
use App\Repositories\ProductFileRepositoryInterface;
use App\Repositories\ProductRepository;
use App\Repositories\ProductRepositoryInterface;
use Exception;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Http;


class ImportProductService
{
    public function __construct (
        private readonly ProductFileRepositoryInterface $productFileRepository,
        private readonly ProductRepositoryInterface $productRepository
    ) {}

    public function populate()
    {
        $fileName = $this->productFileRepository->getNextFile();

        if (!$fileName) {
            echo "Todos arquivos ja importados!";
            return;
        }

        $zipTemporario = storage_path("/temporario.gz");
        $unZipTemporario = storage_path("/data.json");

        try {
            $response = Http::timeout(120)->get("https://challenges.coode.sh/food/data/json/{$fileName['name']}");

            if ($response->successful()) {
                file_put_contents($zipTemporario, $response->body());
                $this->productFileRepository->setFileOpened($fileName);
            }

        } catch (Exception $e) {
            echo $e;
        }

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
                $jsonObject['code'] = str_replace("\"", "", $jsonObject['code']);

                $productExists = $this->productRepository->findByCode($jsonObject);

                if (!$productExists) {
                    $this->productRepository->createProduct($jsonObject);
                }

                $cont++;
            }
        }

        fclose($json_data);

        unlink($zipTemporario);
        unlink($unZipTemporario);
    }
}