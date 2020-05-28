<?php

namespace App\Http\Requests\Auth;


class RegisterRequest extends LoginRequest
{

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return array_merge(parent::rules(), [
            'email' => 'required|email:dns|unique:users',
            'name' => 'required|string'
        ]);
    }

    /**
     * @return array
     */
    public function messages()
    {
        return parent::messages();
    }
}
