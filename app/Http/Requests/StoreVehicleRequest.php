<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreVehicleRequest extends FormRequest
{
    public function authorize(): bool
    {
        // Only admin and sales can create vehicles
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
            'category_id.exists' => 'Kategori tidak valid',
            'name.required' => 'Nama kendaraan harus diisi',
            'brand.required' => 'Merek harus diisi',
            'model.required' => 'Model harus diisi',
            'year.required' => 'Tahun produksi harus diisi',
            'year.integer' => 'Tahun harus berupa angka',
            'year.min' => 'Tahun minimal 2000',
            'price.required' => 'Harga harus diisi',
            'price.numeric' => 'Harga harus berupa angka',
            'stock.required' => 'Stok harus diisi',
            'stock.integer' => 'Stok harus berupa angka',
            'images.*.image' => 'File harus berupa gambar',
            'images.*.mimes' => 'Format gambar harus jpeg, png, atau jpg',
            'images.*.max' => 'Ukuran gambar maksimal 2MB',
            'condition.required' => 'Kondisi harus dipilih',
            'condition.in' => 'Kondisi harus new atau used',
        ];
    }
}
