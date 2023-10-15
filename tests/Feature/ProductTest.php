<?php

namespace Tests\Feature;

use App\Http\Requests\ProductRequest;
use App\Repositories\ProductRepository;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ProductTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function test_get_products(): void
    {
        $response = $this->get('/api/products');
        $response->assertStatus(200);
    }

    public function test_get_product_by_id(): void
    {
        $response = $this->get('/api/products/1');
        $response->assertStatus(200);
    }

    public function test_put_product(): void
    {
        /** @var ProductRepository $repository */
        $repository = $this->app->make(ProductRepository::class);

        $product = $repository->findById(1);

        $response = $this->put('/api/products/1', [
            'code' => '09091234'
        ]);

        $response->assertStatus(200);
    }
}
