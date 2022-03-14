<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class Faq extends FormRequest
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
            "faq" => 'required',
            "answer" => 'required',
            "gigId" => "required|exists:gigs,id,deleted_at,NULL"
        ];
    }
}
