<?php

namespace App\Http\Requests\user\administrators;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Validation\ValidationException;
use Symfony\Component\HttpFoundation\Response;

class AdminRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {

        $rules = [
            'name' => 'required|unique:users',
            'password' => 'required|confirmed|min:6|max:12',
            'role_id' => 'required'
        ];

        if(\Route::currentRouteName() == 'admins.update'){
            $rules = [
                'password' => 'required|confirmed|min:6|max:12'
            ];            
        };
        return $rules;
    }
    /**
     * 提示信息s
     * @return array
     */
    public function messages()
    {
        return [
            'name.required'   => '姓名不能为空！',
            'name.unique'     => '用户名已存在！',
            'role_id.required' => '请选择角色！'
        ];
    }

    // 重写ajax请求验证错误响应格式（防止验证422报错）
    protected function failedValidation(Validator $validator)
    {
        // 此处自定义您想要返回的数据类型
        $data = [
            'status' => 400,
            'msg' => $validator->errors()->first(),
        ];
        $respone = new Response(json_encode($data));
        throw (new ValidationException($validator, $respone))
            ->errorBag($this->errorBag)
            ->redirectTo($this->getRedirectUrl());
    }
}
