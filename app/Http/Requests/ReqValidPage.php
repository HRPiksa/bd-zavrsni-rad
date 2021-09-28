<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class ReqValidPage extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
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
            'title'     => 'required',
            'url'       => 'required',
            'content'   => 'required',
            'image'     => 'required',
            'order'     => 'required',
            'orderPage' => 'required'
        );
    }

    public function messages()
    {
        return array(
            'title.required'     => 'Morate unijeti naslov.',
            'url.required'       => 'Morate unijeti URL.',
            'content.required'   => 'Morate unijeti neki sadržaj.',
            'image.required'     => 'Morate odabrati sliku.',
            'order.required'     => 'Morate odabrati poredak.',
            'orderPage.required' => 'Morate odabrati stranicu za poredak.'
        );
    }
}
