<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateVehicleRequest extends FormRequest
{
    public function authorize(): bool
    {
        return $this->user()->isAdmin() || $this->user()->isSales();
    }

    public function rules(): array
    {
        return [
            'category_id' => 'required|exists:categories,id',
            'name' => 'required|string|max:255',
            'brand' => 'required|string|max:255',
            'model' => 'required|string|max:255',
            'year' => 'required|integer|min:2000|max:' . (date('Y') + 1),
            'price' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:0',
            'description' => 'nullable|string',
            'specifications' => 'nullable|array',
            'images.*' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'condition' => 'required|in:new,used',
            'is_featured' => 'boolean',
        ];
    }

    public function messages(): array
    {
        return [
            'category_id.required' => 'Kategori harus dipilih',
            'name.required' => 'Nama kendaraan harus diisi',
            'price.required' => 'Harga harus diisi',
            'stock.required' => 'Stok harus diisi',
        ];
    }
}
