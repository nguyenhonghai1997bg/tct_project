<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreProductRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'required|min:3|max:191|unique:products',
            'category_id' => 'required',
            'description' => 'required|min:3|max:191',
            'detail' => 'required|min:3',
            'price' => 'required|numeric|max:100000000',
            'depot_name' => 'required|min:3|max:191',
            'quantity' => 'required|numeric|max:100000000',
            'sale_price' => 'nullable|numeric|max:100',
            'images' => 'required',
            'image_product' => 'required|image'
        ];
    }
}
