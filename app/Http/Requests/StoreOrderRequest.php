<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreOrderRequest extends FormRequest
{
    public function authorize(): bool
    {
        return $this->user()->isCustomer();
    }

    public function rules(): array
    {
        return [
            'items' => 'required|array|min:1',
            'items.*.type' => 'required|in:vehicle,spare_part',
            'items.*.id' => 'required|integer',
            'items.*.quantity' => 'required|integer|min:1',
            'shipping_address' => 'required|string',
            'notes' => 'nullable|string',
            'payment_method' => 'required|in:transfer,midtrans,cash',
        ];
    }

    public function messages(): array
    {
        return [
            'items.required' => 'Keranjang belanja kosong',
            'items.min' => 'Minimal 1 item harus dipilih',
            'items.*.type.required' => 'Tipe item harus dipilih',
            'items.*.id.required' => 'Item tidak valid',
            'items.*.quantity.required' => 'Jumlah harus diisi',
            'items.*.quantity.min' => 'Jumlah minimal 1',
            'shipping_address.required' => 'Alamat pengiriman harus diisi',
            'payment_method.required' => 'Metode pembayaran harus dipilih',
        ];
    }
}
