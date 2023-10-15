<?php

namespace App\Console\Commands;

use App\Services\ImportProductService;
use Illuminate\Console\Command;

class ImportProducts extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'import:products';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Importa dados mais recentes do Open Food para o banco de dados.';

    /**
     * Execute the console command.
     */
    public function handle(ImportProductService $productService)
    {
        $productService->populate();
    }
}
