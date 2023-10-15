<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

use function Laravel\Prompts\table;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('code')->unique();
            $table->enum('status', ['draft', 'trash', 'published']);
            $table->string('imported_t');
            $table->string('url')->nullable()->default('');
            $table->string('creator')->nullable()->default('');
            $table->string('created_t')->nullable()->default('');
            $table->string('last_modified_t')->nullable()->default('');
            $table->string('product_name')->nullable()->default('');
            $table->string('quantity')->nullable()->default('');
            $table->string('brands')->nullable()->default('');
            $table->string('categories')->nullable()->default('');
            $table->string('labels')->nullable()->default('');
            $table->string('cities')->nullable()->default('');
            $table->string('purchase_places')->nullable()->default('');
            $table->string('stores')->nullable()->default('');
            $table->text('ingredients_text')->nullable()->default('');
            $table->string('traces')->nullable()->default('');
            $table->string('serving_size')->nullable()->default('');
            $table->string('serving_quantity')->nullable()->default('');
            $table->string('nutriscore_score')->nullable()->default('');
            $table->string('nutriscore_grade')->nullable()->default('');
            $table->string('main_category')->nullable()->default('');
            $table->string('image_url')->nullable()->default('');
            // $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
