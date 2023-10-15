<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ProductRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            "url" => ['nullable', 'string'],
            "creator" => ['nullable', 'string'],
            "product_name" => ['nullable', 'string'],
            "quantity" => ['nullable', 'string'],
            "brands" => ['nullable', 'string'],
            "categories" => ['nullable', 'string'],
            "labels" => ['nullable', 'string'],
            "cities" => ['nullable', 'string'],
            "purchase_places" => ['nullable', 'string'],
            "stores" => ['nullable', 'string'],
            "ingredients_text" =>'nullable',  ['text'],
            "traces" => ['nullable', 'string'],
            "serving_size" => ['nullable', 'string'],
            "serving_quantity" => ['nullable', 'string'],
            "nutriscore_score" => ['nullable', 'string'],
            "nutriscore_grade" => ['nullable', 'string'],
            "main_category" => ['nullable', 'string'],
            "image_url" => ['nullable', 'string'],
        ];
    }
}
