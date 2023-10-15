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
            "code" => ['string', Rule::unique('products')->ignore($this->route('product'))],
            "url" => ['string', 'nullable'],
            "creator" => ['string', 'nullable'],
            "product_name" => ['string', 'nullable'],
            "quantity" => ['string', 'nullable'],
            "brands" => ['string', 'nullable'],
            "categories" => ['string', 'nullable'],
            "labels" => ['string', 'nullable'],
            "cities" => ['string', 'nullable'],
            "purchase_places" => ['string', 'nullable'],
            "stores" => ['string', 'nullable'],
            "ingredients_text" => ['text', 'nullable'],
            "traces" => ['string', 'nullable'],
            "serving_size" => ['string', 'nullable'],
            "serving_quantity" => ['string', 'nullable'],
            "nutriscore_score" => ['string', 'nullable'],
            "nutriscore_grade" => ['string', 'nullable'],
            "main_category" => ['string', 'nullable'],
            "image_url" => ['string', 'nullable'],
        ];
    }
}
