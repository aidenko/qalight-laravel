<?php

namespace App\Http\Requests\Admin\Category;

use App\Tag;
use Illuminate\Foundation\Http\FormRequest;

class Store extends FormRequest{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize() {
        return $this->user()->can('create', Tag::class);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules() {
        return [
            'name' => 'required|max:255',
            'parent_id' => 'nullable|exists:categories,id'
        ];
    }
}
