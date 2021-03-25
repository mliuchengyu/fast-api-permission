<?php

namespace Edu\Permission\Requests\AdminRole;

use Illuminate\Foundation\Http\FormRequest;

class AuthAdminRoleRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'permissions' => 'required',
        ];
    }
}
