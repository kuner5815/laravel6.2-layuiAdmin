<?php

namespace App\Http\Requests\user;

use Illuminate\Foundation\Http\FormRequest;

class SessionRequest extends FormRequest
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
            'name' => ['required','max:30'],
            'password' => ['required', 'string', 'min:6'],
            'captcha' => ['required', 'captcha'],
            //'price' => 'required'
        ];
        return $rules;
    }
    /**
     * 提示信息s
     * @return array
     */
    public function messages()
    {
        return [
            'captcha.required' => '验证码不能为空',
            'captcha.captcha' => '请输入正确的验证码'
        ];
    }
}
