<?php

namespace App\Http\Requests\Admin\Article;

use App\Article;
use Illuminate\Foundation\Http\FormRequest;

class Store extends FormRequest{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize() {
        return $this->user()->can('create', Article::class);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules() {
        return [
            'title' => 'required|max:256',
            'article' => 'required',
            'category_id' => 'nullable|exists:categories,id'
        ];
    }
}
