<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreProductoRequest extends FormRequest
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
            'nombre' => 'required|unique:productos,nombre|max:100',
            'descripcion' => 'nullable|max:100',
            'precio_unitario' => 'required|integer',
            'img_path' => 'nullable|image:png,jpg,jpeg|max:2048',
            'categoria_id' => 'required|integer|exists:categorias,id',
        ];
    }
}
