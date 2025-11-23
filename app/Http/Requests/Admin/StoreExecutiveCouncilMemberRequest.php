<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class StoreExecutiveCouncilMemberRequest extends FormRequest
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
        return [
            'name' => 'required|string|max:255',
            'position' => 'required|string|max:255',
            'slug' => 'nullable|string|max:255|unique:executive_council_members',
            'image' => 'required|url',
            'biography' => 'required|string',
            'display_order' => 'nullable|integer|min:0',
            'is_active' => 'nullable|boolean',
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
            'name.required' => 'The member name is required.',
            'position.required' => 'The member position is required.',
            'image.required' => 'An image URL is required.',
            'image.url' => 'The image must be a valid URL.',
            'biography.required' => 'A biography is required.',
            'slug.unique' => 'This slug is already in use.',
            'display_order.min' => 'Display order must be 0 or greater.',
        ];
    }
}
