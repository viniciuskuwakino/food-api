<?php

namespace App\Repositories;

use App\Http\Requests\ProductRequest;
use App\Models\Product;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;

class ProductRepository implements ProductRepositoryInterface
{

    public function __construct(
        protected readonly Product $model
    ){}

    public function listAll(): LengthAwarePaginator
    {
        return $this->model->paginate();
    }

    public function findById(int $productId): Product | null
    {
        return $this->model::whereId($productId)->first();
    }

    public function findByCode(string $productCode): Product | null
    {
        return $this->model::where('code', $productCode)->first();
    }


    public function update(ProductRequest $request, Product $product): Product
    {

//        dd($request->all());
        $product->fill($request->all());
        $product['status'] = 'draft';
        $product->save();

        return $product;
    }

    public function destroy(Product $product): void
     {
         $product['status'] = 'trash';
         $product->save();
     }

    public function createProduct(array $product): void
    {
        $this->model->create([
            "code" => $product['code'],
            "status" => 'published',
            "imported_t" => (string) date('d-m-Y H:i:s'),
            "url" => $product['url'],
            "creator" => $product['creator'],
            "created_t" => $product['created_t'],
            "last_modified_t" => $product['last_modified_t'],
            "product_name" => $product['product_name'],
            "quantity" => $product['quantity'],
            "brands" => $product['brands'],
            "categories" => $product['categories'],
            "labels" => $product['labels'],
            "cities" => $product['cities'],
            "purchase_places" => $product['purchase_places'],
            "stores" => $product['stores'],
            "ingredients_text" => $product['ingredients_text'],
            "traces" => $product['traces'],
            "serving_size" => $product['serving_size'],
            "serving_quantity" => $product['serving_quantity'],
            "nutriscore_score" => $product['nutriscore_score'],
            "nutriscore_grade" => $product['nutriscore_grade'],
            "main_category" => $product['main_category'],
            "image_url" => $product['image_url'],
        ]);
    }

}