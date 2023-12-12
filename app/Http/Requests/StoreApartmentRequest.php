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
            'title' => ['bail', 'required', 'min:5', 'max:100', 'unique:apartments,title'],
            'nation' => ['required', 'string'],
            'address' => ['required', 'string'],
            'rooms' => ['required', 'numeric', 'min:1', 'max:25'],
            'bathrooms' => ['required', 'numeric', 'min:1', 'max:25'],
            'beds' => ['required', 'numeric', 'min:1', 'max:25'],
            'm_square' => ['required', 'numeric', 'min:10'],
            'description' => ['bail', 'required', 'min:10', 'max:1000'],
            'thumbnail' => ['required', 'image'], #'mimes:'png,jpg'
            'gallery' => ['required', 'array'],
            'services' => ['nullable', 'exists:services,id'],
            'visible' => ['required'],

        ];
    }
}
