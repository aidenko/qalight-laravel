<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class ArticleRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'title' => 'required|max:255',
            'article' => 'required',
            'category_id' => 'sometimes|required|exists:categories,id',
            'user_id' => 'required|exists:users,id',
            'author_id' => 'required|exists:users,id'
        ];
    }
}
