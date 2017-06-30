<?php

namespace App\Http\Requests\Admin\Tag;

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
            'name' => 'required|max:64|unique:tags'
        ];
    }
}
