<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class Task extends FormRequest
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
            "description" => "required|string",
            "start_date" => "required|date|before:end_date",
            "end_date" => "required|date|after:start_date",
            // "taskcontainerId" => "required|numeric|exists:task_containers,id,deleted_at,NULL"
        ];
    }
}
