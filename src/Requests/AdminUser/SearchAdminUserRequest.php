<?php

namespace Fast\Api\Permission\Requests\AdminUser;

use Illuminate\Foundation\Http\FormRequest;

class SearchAdminUserRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'keyword' => 'string',
        ];
    }
}
