<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class UpdateRealEstatePropertyRequest extends FormRequest
{
    public function authorize(): bool
    {
        return Auth::check();
    }

    public function rules(): array
    {
        $propertyId = $this->route('id');

        return [
            'property_name' => ['required', 'string', 'max:255', Rule::unique('real_estate_properties', 'property_name')->ignore($propertyId)],
            'property_type' => ['required', 'string', 'max:120'],
            'description' => ['required', 'string'],
            'country' => ['required', 'string', 'max:120'],
            'state' => ['required', 'string', 'max:120'],
            'city' => ['required', 'string', 'max:120'],
            'address' => ['required', 'string', 'max:255'],
            'bedrooms' => ['required', 'integer', 'min:0'],
            'bathrooms' => ['required', 'integer', 'min:0'],
            'living_rooms' => ['required', 'integer', 'min:0'],
            'kitchens' => ['required', 'integer', 'min:0'],
            'parking_spaces' => ['required', 'integer', 'min:0'],
            'property_size' => ['required', 'numeric', 'min:0'],
            'year_built' => ['required', 'integer', 'min:1800', 'max:' . now()->year],
            'market_value' => ['required', 'numeric', 'min:0'],
            'token_price' => ['required', 'numeric', 'min:0.01'],
            'total_tokens' => ['required', 'integer', 'min:1'],
            'minimum_investment' => ['required', 'numeric', 'min:1'],
            'maximum_investment' => ['required', 'numeric', 'gte:minimum_investment'],
            'estimated_apy' => ['required', 'numeric', 'between:0,100'],
            'expected_annual_return' => ['nullable', 'numeric', 'min:0'],
            'property_status' => ['required', Rule::in(['Active', 'Upcoming', 'Under Review', 'Suspended', 'Sold Out'])],
            'featured_property' => ['sometimes', 'boolean'],
            'main_image' => ['nullable', 'string', 'max:1000'],
            'main_image_file' => ['nullable', 'image', 'mimes:jpeg,png,jpg,webp', 'max:5120'],
            'gallery_urls' => ['nullable', 'string'],
            'gallery_images' => ['nullable', 'array'],
            'gallery_images.*' => ['image', 'mimes:jpeg,png,jpg,webp', 'max:5120'],
        ];
    }

    protected function prepareForValidation(): void
    {
        if ($this->has('featured_property')) {
            $this->merge(['featured_property' => filter_var($this->input('featured_property'), FILTER_VALIDATE_BOOLEAN)]);
        }
    }
}
