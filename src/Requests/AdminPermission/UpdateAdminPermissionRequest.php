<?php

namespace Edu\Permission\Requests\AdminPermission;

use Edu\Permission\Models\AdminPermission;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateAdminPermissionRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $permissionId = $this->route('permission');
        return [
            'id' => 'exists:Edu\Permission\Models\AdminPermission,id',
            'name' => [
                'required',
                'max:60'
            ],
            'slug' => [
                'required',
                Rule::unique('admin_permissions')->ignore($permissionId),
                'max:100'
            ],
            'parent_id' => [
                'exclude_if:parent_id,0',
                Rule::notIn([$permissionId]),
                Rule::exists(AdminPermission::class, "id")
            ],
        ];
    }
}
