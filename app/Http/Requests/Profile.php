<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class Profile extends FormRequest
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
            'firstname' => 'required',
            'lastname' => 'required',
            'gender' => 'required',
            'phone_number' => 'required|numeric',
            //'address' => 'required',
            'countryId' => 'required|numeric',
            'stateId' => 'required|numeric',
            'accounttypeId' => 'required|numeric|in:1,2',
            //'cityId' => 'required|numeric',
            'profile_image' => 'nullable|max:10000|mimes:png,jpeg,jpg'
        ];
    }
}
