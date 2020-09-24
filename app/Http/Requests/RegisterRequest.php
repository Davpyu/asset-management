<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
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
            'nama'      => ['required', 'string', 'regex:/^[A-Za-z ]+$/'],
            'username'  => ['required', 'string', 'unique:users,username'],
            'password'  => ['required', 'string', 'confirmed'],
            'email'     => ['required', 'email', 'unique:users,email'],
            'no_hp'     => ['required', 'string', 'regex:/^[\+]?[(]?[0-9]{3}[)]?[-\s\.]?[0-9]{3}[-\s\.]?[0-9]{4,6}$/'],
            'alamat'    => ['required', 'string']
        ];
    }
}
