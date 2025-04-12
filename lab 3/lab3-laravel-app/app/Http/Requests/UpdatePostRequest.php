<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdatePostRequest extends FormRequest
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
           'title' => ['required', 'min:3',
                Rule::unique('posts', 'title')->ignore($this->route('post'), 'id'),
            ],
            'description' => ['required', 'min:10'],
            'post_creator' => ['required', 'exists:users,id'],
            'image' => 'nullable|image|mimes:jpg,png,jpeg'
        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array<string, string>
     */
    public function messages(): array
    {
        return [
            'title.required' => 'Title is required.',
            'title.min' => 'Title must be at least 3 characters.',
            'title.unique' => 'This title has already been taken.',

            'description.required' => 'Description is required.',
            'description.min' => 'Description must be at least 10 characters.',

            'post_creator.required' => 'Post creator is required.',
            'post_creator.exists' => 'Selected creator is invalid.',

        ];
    }
}