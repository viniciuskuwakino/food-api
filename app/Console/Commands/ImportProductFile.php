<?php

namespace App\Console\Commands;

use App\Services\ProductFileService;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;

class ImportProductFile extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'import:product-files';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Importa os nomes dos arquivos que contem os produtos';

    /**
     * Execute the console command.
     */
    public function handle(ProductFileService $service)
    {
        $response = Http::get("https://challenges.coode.sh/food/data/json/index.txt");
        $service->addFileNames($response->body());
    }
}
