<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class ReqValidUserCreate extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        //return false;
        return Auth::check();

    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return array(
            'firstname' => 'required',
            'lastname'  => 'required',
            'email'     => 'required|email|unique:users,email',
            'username'  => 'required|unique:users,username',
            'password'  => 'required',
            'roles'     => 'required'
        );
    }

    public function messages()
    {
        return array(
            'firstname.required'             => 'Morate unijeti ime.',
            'lastname.required'              => 'Morate unijeti prezime.',
            'email.required'                 => 'Morate unijeti email adresu.',
            'email.email'                    => 'Email adresa nije ispravna.',
            'email.unique:users,email'       => 'Email adresa nije jedinstvena.',
            'username.required'              => 'Morate unijeti korisničko ime.',
            'username.unique:users,username' => 'Korisničko ime nije jedinstveno.',
            'password.required'              => 'Morate unijeti lozinku.',
            'roles.required'                 => 'Morate definirati uloge.'
        );
    }
}
