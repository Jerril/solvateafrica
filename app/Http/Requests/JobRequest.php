<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class JobRequest extends FormRequest
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
            'job_description' => 'required',
            'milestone' => 'required',
            'price_budget' => 'required',
            'category' => 'required',
            'job_type' => 'required',
            'skill' => 'required',
        ];
    }
}