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
     * Using Laravel's validation prevents SQL injection through parameterized queries.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => [
                'required',
                'string',
                'max:255',
                // Prevent potentially dangerous characters
                'regex:/^[a-zA-Z0-9\s\-\_\.\,\!\?\(\)]+$/u',
            ],
            'description' => [
                'required',
                'string',
                'max:5000',
            ],
            'price' => [
                'required',
                'numeric',
                'min:0',
                'max:999999.99',
            ],
            'image' => [
                'nullable',
                'string',
                'url',
                'max:500',
            ],
            'brand' => [
                'required',
                'string',
                'max:100',
            ],
            'sku' => [
                'nullable',
                'string',
                'max:100',
                Rule::unique('products', 'sku')->ignore($this->route('product')),
            ],
            'color' => [
                'nullable',
                'string',
                'max:50',
            ],
            'ram' => [
                'nullable',
                'string',
                'max:20',
            ],
            'rom' => [
                'nullable',
                'string',
                'max:20',
            ],
            'screen_size' => [
                'nullable',
                'string',
                'max:20',
            ],
            'battery' => [
                'nullable',
                'string',
                'max:30',
            ],
            'stock' => [
                'nullable',
                'integer',
                'min:0',
            ],
        ];
    }

    /**
     * Get custom messages for validator errors.
     *
     * @return array<string, string>
     */
    public function messages(): array
    {
        return [
            'name.required' => 'Product name is required.',
            'name.regex' => 'Product name contains invalid characters.',
            'name.max' => 'Product name cannot exceed 255 characters.',
            'description.required' => 'Product description is required.',
            'description.max' => 'Product description cannot exceed 5000 characters.',
            'price.required' => 'Product price is required.',
            'price.numeric' => 'Product price must be a valid number.',
            'price.min' => 'Product price cannot be negative.',
            'price.max' => 'Product price cannot exceed 999,999.99.',
            'image.url' => 'Product image must be a valid URL.',
            'brand.required' => 'Brand is required.',
            'stock.integer' => 'Stock must be a whole number.',
            'stock.min' => 'Stock cannot be negative.',
        ];
    }

    /**
     * Prepare the data for validation.
     * This sanitizes input before validation to prevent XSS.
     */
    protected function prepareForValidation(): void
    {
        if ($this->has('name')) {
            $this->merge([
                'name' => strip_tags($this->name),
            ]);
        }

        if ($this->has('description')) {
            $this->merge([
                'description' => strip_tags($this->description),
            ]);
        }

        if ($this->has('price')) {
            $this->merge([
                'price' => filter_var($this->price, FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION),
            ]);
        }

        foreach (['brand', 'sku', 'color', 'ram', 'rom', 'screen_size', 'battery'] as $field) {
            if ($this->has($field) && $this->$field !== null) {
                $this->merge([$field => strip_tags(trim($this->$field))]);
            }
        }
    }
}
