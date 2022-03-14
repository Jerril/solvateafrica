<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TaskContainer extends FormRequest
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
            "name" => "required|string",
            "projectId" => "required|exists:projects,id,deleted_at,NULL"
        ];
    }
}
