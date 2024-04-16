<?php

namespace App\Http\Requests;

use App\Models\Category;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Illuminate\Validation\ValidationException;

class StoreArticleRequest extends FormRequest
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
            'title' => ['required', 'string', 'max:255', 'unique:articles'],
            'excerpt' => ['required', 'string'],
            'description' => ['required', 'string'],
            'status' => ['in:on'],
            'category_id' => ['required', 'integer', 'exists:categories,id'],
            'tags' => ['nullable', 'array'],
            'tags.*' => ['integer', Rule::exists('tags', 'id')]
        ];
    }

    // public ?Category $category;

    // public function validate($rules, ...$params)
    // {
    //     $valid = parent::validate($rules, ...$params);

    //     $this->category = Category::find($this->get('category_id'));

    //     if ($this->category->is_disabled) {
    //         throw ValidationException::withMessages([
    //             'category_id' => ['This category is not enabled.']
    //         ])
    //     }



    // }
}
