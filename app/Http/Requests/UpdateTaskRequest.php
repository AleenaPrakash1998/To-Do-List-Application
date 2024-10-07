<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class UpdateTaskRequest extends FormRequest
{
    public function rules(Request $request): array
    {
        $taskId = $request->route('task');
        return [
            'title' => [
                'required',
                'string',
                'max:255',
                Rule::unique('tasks')->ignore($taskId),
            ],
            'description' => 'required|string',
            'status' => 'required',
            'due_date' => 'required',
        ];
    }
}
