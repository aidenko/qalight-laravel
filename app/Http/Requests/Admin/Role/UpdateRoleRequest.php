<?php

namespace App\Http\Requests\Admin\Role;

use App\Role;
use Illuminate\Foundation\Http\FormRequest;

class UpdateRoleRequest extends FormRequest{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize() {

        $role = Role::find($this->route('role'));

        return $role && $this->user()->can('update', $role);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules() {
        return [
            'parent_id' => 'nullable|exists:roles,id'
        ];
    }
}
