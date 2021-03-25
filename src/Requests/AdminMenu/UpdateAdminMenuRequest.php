<?php

namespace Edu\Permission\Requests\AdminMenu;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Edu\Permission\Models\AdminMenu;

class UpdateAdminMenuRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $menuId = $this->route('menu');
        $rules = [
            'id' => Rule::exists(AdminMenu::class, "id"),
            'title' => [
                'required',
                'max:60'
            ],
            'path' => [
                'required',
                Rule::unique('admin_menus')->ignore($menuId),
                'max:100'
            ],
            'parent_id' => [
                'exclude_if:parent_id,0',
                Rule::notIn([$menuId]),
                Rule::exists(AdminMenu::class, "id")
            ],
            'roles' => 'required'
        ];
        return $rules;
    }
}
