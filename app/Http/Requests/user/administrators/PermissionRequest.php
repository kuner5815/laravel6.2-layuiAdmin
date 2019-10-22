<?php

namespace App\Http\Requests\user\administrators;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Validation\ValidationException;
use Symfony\Component\HttpFoundation\Response;

class PermissionRequest extends FormRequest
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
        return [
            'name'   => 'required|between:2,10',
            'remark' => 'max:128',
            'sort'  => 'required:integer',
        ];
    }

    public function messages()
    {
        return [
            'name.required'   => '权限不能为空',
            'name.between'    => '权限名称长度应该在2~10位之间',
            'name.unique'     => '权限已存在！',
            'remark.max'      => '角色描述不能超过128个字符',
            'sort.required'   => '排序不能为空',
            'order.integer'   => '表单不合法',
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
