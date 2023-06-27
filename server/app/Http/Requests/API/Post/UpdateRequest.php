<?php

namespace App\Http\Requests\API\Post;

use Illuminate\Foundation\Http\FormRequest;

class UpdateRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'title' => 'required|string|min:3|max:100',
            'location' => 'required|string|min:1|max:100',
            'description' => 'required|string|min:1'
        ];
    }
}
