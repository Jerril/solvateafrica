<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ScopePackage extends FormRequest
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
            "packages*.package" => "required|string",
            "packages*.offers" => "required",
            "packages*.delivery" => "required|numeric",
            "packages*.revisions" => "required|numeric",
            "gigId" => "required|exists:gigs,id,deleted_at,NULL",
            "packages*.price" => "required|numeric"
        ];
    }
}
