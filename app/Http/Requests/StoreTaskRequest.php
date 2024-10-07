<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreTaskRequest extends FormRequest
{

    public function rules(): array
    {
        return [
            'title' => 'required|string|max:255|unique:tasks',
            'description' => 'required|string',
            'status' => 'required',
            'due_date' => 'required',
        ];
    }
}
