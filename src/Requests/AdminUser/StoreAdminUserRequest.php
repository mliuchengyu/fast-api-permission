<?php

namespace Edu\Permission\Requests\AdminUser;

use Illuminate\Foundation\Http\FormRequest;

class StoreAdminUserRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'username' => 'required|unique:admin_users|max:30',
            'name' => 'required',
            'company_code' => 'required',
            'staff_code' => 'required|unique:admin_users|max:4',
            'password' => 'required|min:6',
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
            'company_code.required' => '公司代码不能为空！',
            'staff_code.required' => '员工代码不能为空！',
            'staff_code.max' => '员工代码限制4个字符长度！',
            'staff_code.unique' => '员工代码不能重复！',
            'password.required' => '密码不能为空！',
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
        $validator->after(function ($validator) use ($password) {
            $password = bcrypt($password);
            $this->merge([
                'password' => $password
            ]);
        });
    }
}
