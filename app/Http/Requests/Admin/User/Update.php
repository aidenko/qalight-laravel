<?php

namespace App\Http\Requests\Admin\User;

use App\User;
use Illuminate\Foundation\Http\FormRequest;

class Update extends FormRequest{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize() {

        $user = User::find($this->route('user'));

        return $user && $this->user()->can('create', $user);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules() {
        return [
            'name' => 'required',
            'email' => 'required|email|unique:users,email,'.$this->route('user'),
            'password' => 'required',
            'roles' => 'sometimes|exists:roles,id'
        ];
    }
}
