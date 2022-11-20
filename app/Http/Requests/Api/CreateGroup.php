<?php

namespace App\Http\Requests\Api;

use Illuminate\Foundation\Http\FormRequest;

class CreateGroup extends FormRequest
{
    public function rules()
    {
        return [
            'title' => 'required|string|max:255',
            'description' => 'string|max:255',
        ];
    }
}
