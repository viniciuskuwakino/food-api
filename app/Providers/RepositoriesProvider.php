<?php

namespace App\Providers;

use App\Repositories\ProductRepository;
use App\Repositories\ProductRepositoryInterface;
use Illuminate\Support\ServiceProvider;

class RepositoriesProvider extends ServiceProvider
{

    public array $bindings = [
        ProductRepositoryInterface::class => ProductRepository::class
    ];

}
