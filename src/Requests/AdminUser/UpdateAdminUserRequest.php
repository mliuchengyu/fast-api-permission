<?php

namespace Edu\Permission\Requests\AdminUser;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateAdminUserRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $userId = $this->route('user');
        return [
            'id' => 'exists:Edu\Permission\Models\AdminUser,id',
            'username' => [
                'required',
                Rule::unique('admin_users')->ignore($userId),
                'max:30'
            ],
            'name' => 'required',
            'password' => 'filled|min:6',
            'rolesIds' => 'required',
        ];
    }

    /**
     * 获取已定义验证规则的错误消息
     *
     * @return array
     */
    public function messages()
    {
        return [
            'username.required'  => '用户名不能为空！',
            'name.required' => '中文名称不能为空！',
            'rolesIds.required' => '拥有角色不能为空！',
        ];
    }

    /**
     * 配置验证实例
     *
     * @param \Illuminate\Validation\Validator $validator
     * @return void
     */
    public function withValidator($validator)
    {
        if ($validator->errors()->all()) {
            return;
        }
        $password = $this->input('password');
        if ($password){
            $validator->after(function ($validator) use ($password) {
                $password = bcrypt($password);
                $this->merge([
                    'password' => $password
                ]);
            });
        }

    }
}
