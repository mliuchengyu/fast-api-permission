<?php

namespace Edu\Permission\Requests\AdminRole;

use Illuminate\Foundation\Http\FormRequest;

class SearchAdminRoleRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'string',
            'slug' => 'string'
        ];
    }
}
