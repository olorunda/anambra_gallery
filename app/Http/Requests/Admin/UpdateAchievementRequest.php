<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class UpdateAchievementRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true; // Assuming admin authentication is handled by middleware
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        $achievementId = $this->route('achievement')->id ?? null;

        return [
            'title' => 'required|string|max:255',
            'slug' => 'nullable|string|max:255|unique:achievements,slug,'.$achievementId,
            'description' => 'required|string',
            'content' => 'nullable|string',
            'achievement_date' => 'nullable|date',
            'category' => 'nullable|string|max:255',
            'meta_data' => 'nullable|array',
            'is_active' => 'nullable|boolean',
            'sort_order' => 'nullable|integer|min:0',
            'images' => 'nullable|array|max:10',
            'images.*' => 'required|image|mimes:jpeg,png,jpg,gif,webp|max:5120',
            'image_alt_texts' => 'nullable|array',
            'image_alt_texts.*' => 'nullable|string|max:255',
            'existing_image_ids' => 'nullable|array',
            'existing_image_ids.*' => 'integer|exists:images,id',
            'existing_alt_texts' => 'nullable|array',
            'existing_alt_texts.*' => 'nullable|string|max:255',
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
            'title.required' => 'The achievement title is required.',
            'title.max' => 'The achievement title may not be greater than 255 characters.',
            'description.required' => 'A description is required.',
            'slug.unique' => 'This slug is already in use.',
            'achievement_date.date' => 'The achievement date must be a valid date.',
            'sort_order.min' => 'Sort order must be 0 or greater.',
        ];
    }
}
