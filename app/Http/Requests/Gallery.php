<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class Gallery extends FormRequest
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
            "gigId" => "required|exists:gigs,id",
            "images.*.image" => "required|max:10000|mimes:jpeg,png,jpg"
        ];
    }
}
