<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorePropertyRequest extends FormRequest
{
    public function authorize(): bool
    {
        return $this->user()->can('create', \App\Models\Property::class);
    }

    public function rules(): array
    {
        return [
            'title' => ['required', 'string', 'max:255'],
            'description' => ['required', 'string'],
            'youtube_url' => ['nullable', 'url', 'regex:/^(https?:\/\/)?(www\.)?(youtube\.com|youtu\.be)\/.+$/'],
            'price' => ['required', 'numeric', 'min:0'],
            'property_type' => ['required', 'in:sale,rent,lease,shortlet'],
            'location_id' => ['nullable', 'exists:locations,id'],
            'property_category_id' => ['nullable', 'exists:property_categories,id'],
            'bedrooms' => ['required', 'integer', 'min:0'],
            'bathrooms' => ['required', 'integer', 'min:0'],
            'land_size' => ['nullable', 'numeric', 'min:0'],
            'land_size_unit' => ['nullable', 'string', 'in:sqm,sqft,acres,hectares'],
            'address' => ['nullable', 'string', 'max:500'],
            'latitude' => ['nullable', 'numeric', 'between:-90,90'],
            'longitude' => ['nullable', 'numeric', 'between:-180,180'],
            'availability' => ['required', 'in:available,rented,sold,draft'],
            'amenities' => ['nullable', 'array'],
            'amenities.*' => ['exists:amenities,id'],
            'images' => ['nullable', 'array'],
            'images.*' => ['image', 'mimes:jpeg,png,jpg,webp', 'max:5120'],
        ];
    }

    public function messages(): array
    {
        return [
            'title.required' => 'Property title is required.',
            'description.required' => 'Property description is required.',
            'price.required' => 'Property price is required.',
            'youtube_url.url' => 'Please enter a valid URL.',
            'youtube_url.regex' => 'Please enter a valid YouTube URL.',
            'images.*.image' => 'Each file must be an image.',
            'images.*.max' => 'Each image must not exceed 5MB.',
        ];
    }
}
