<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreContactRequest extends FormRequest
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
            'user_id'      => 'required',
            'upload_id'    => 'required',
            'name'         => 'required',
            'phone'        => 'required',
            'addres'       => 'required',
            'credit_card'  => 'required',
            'franchise'    => 'required',
            'email'        => 'required'
        ];
    }
}
