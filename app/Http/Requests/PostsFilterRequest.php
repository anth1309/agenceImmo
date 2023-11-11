<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Str;


class PostsFilterRequest extends FormRequest
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
    // public function rules(): array
    // {
    //     return [
    //         'title' => ['required', 'min:5', 'max:20', 'unique:posts'],
    //         //'slug' => ['required', 'regex:/^[a-z0-9\-]+$/'],
    //     ];
    // }

    //s il n y a pas e slug il le genere
    // protected function prepareForValidation()
    // {
    //     $this->merge([
    //         'slug' => $this->input('slug') ?: Str::slug($this->input('title')),
    //     ]);
    // }
}
