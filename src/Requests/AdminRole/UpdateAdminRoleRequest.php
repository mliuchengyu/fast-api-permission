<?php

namespace Edu\Permission\Requests\AdminRole;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateAdminRoleRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $roleId = $this->route('role');
        return [
            'id' => 'exists:Edu\Permission\Models\AdminRole,id',
            'name' => ['required', Rule::unique('admin_roles')->ignore($roleId)],
            'slug' => ['required', Rule::unique('admin_roles')->ignore($roleId)]
        ];
    }
}
