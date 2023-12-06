<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreApartmentRequest extends FormRequest
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
            'title' => ['required', 'string'],
            'nation' => ['required', 'string'],
            'city' => ['required', 'string'],
            'postal_code' => ['required', 'string'],
            'address' => ['required', 'string'],
            'rooms' => ['required', 'numeric'],
            'bathrooms' => ['required', 'numeric'],
            'beds' => ['required', 'numeric'],
            'm_square' => ['required', 'numeric'],
            'description' => ['required', 'string'],
            'thumbnail' => ['required', 'image'], #'mimes:'png,jpg'
        ];
    }
}
