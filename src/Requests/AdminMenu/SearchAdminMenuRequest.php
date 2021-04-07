<?php

namespace Fast\Api\Permission\Requests\AdminMenu;

use Illuminate\Foundation\Http\FormRequest;

class SearchAdminMenuRequest extends FormRequest
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
