<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class ReqValidUserEdit extends FormRequest
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
            'email'     => 'required|email',
            'roles'     => 'required'
        );
    }

    public function messages()
    {
        return array(
            'firstname.required' => 'Morate unijeti ime.',
            'lastname.required'  => 'Morate unijeti prezime.',
            'email.required'     => 'Morate unijeti email adresu.',
            'email.email'        => 'Email adresa nije ispravna.',
            'roles.required'     => 'Morate definirati uloge.'

        );
    }
}
