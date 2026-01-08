<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreSparePartRequest extends FormRequest
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
            'part_number' => 'required|string|max:255|unique:spare_parts,part_number',
            'brand' => 'required|string|max:255',
            'price' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:0',
            'description' => 'nullable|string',
            'compatible_vehicles' => 'nullable|array',
            'image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'is_available' => 'boolean',
        ];
    }

    public function messages(): array
    {
        return [
            'category_id.required' => 'Kategori harus dipilih',
            'name.required' => 'Nama spare part harus diisi',
            'part_number.required' => 'Nomor part harus diisi',
            'part_number.unique' => 'Nomor part sudah terdaftar',
            'brand.required' => 'Merek harus diisi',
            'price.required' => 'Harga harus diisi',
            'stock.required' => 'Stok harus diisi',
            'image.image' => 'File harus berupa gambar',
            'image.max' => 'Ukuran gambar maksimal 2MB',
        ];
    }
}
