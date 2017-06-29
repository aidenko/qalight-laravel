<?php

namespace App\Http\Requests\Admin\Article;

use App\Article;
use Illuminate\Foundation\Http\FormRequest;

class Update extends FormRequest{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize() {
        $article = Article::find($this->route('article'));

        return $article && $this->user()->can('update', $article);
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
