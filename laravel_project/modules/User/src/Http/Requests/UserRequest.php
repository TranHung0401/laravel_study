<?php

namespace Modules\User\src\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
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
        $id = $this->route()->user;
        $rules = [
            'name' => 'required|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6',
            'group_id' => ['required','integer', function($attribute,$value,$fail) {
                if($value == 0){
                    $fail("You must check group, please");
                }
            }]
        ];

        if($id) {
            $rules['email'] = 'required|email|unique:users,email,'.$id;
            if($this->password){
                $rules['password'] = 'min:6';
            }else {
                unset($rules['password']);
            }

        }

        return $rules;
    }

    public function messages() {
        return [
            'required' => __('user::validate.required'),
            'email' => __('user::validate.email'),
            'unique' => __('user::validate.unique'),
            'min' => __('user::validate.min'),
            'integer' => __('user::validate.integer'),
        ];
    }

    public function attributes() {
        return [
            'name' => __('user::validate.attributes.name'),
            'email' => __('user::validate.attributes.email'),
            'password' => __('user::validate.attributes.password'),
            'group_id' => __('user::validate.attributes.group_id')
        ];
    }
}
