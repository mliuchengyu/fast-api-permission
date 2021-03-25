<?php

namespace Fast\Api\Permission\Requests\AdminRole;

use Illuminate\Foundation\Http\FormRequest;

class StoreAdminRoleRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'required|unique:admin_roles|max:200',
            'slug' => 'required|unique:admin_roles'
        ];
    }
}
