<?php

namespace App\Http\Requests\Admin\Category;

use App\Category;
use Illuminate\Foundation\Http\FormRequest;

class Update extends FormRequest{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize() {

        $category = Category::find($this->route('category'));

        return $category && $this->user()->can('update', $category);
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
