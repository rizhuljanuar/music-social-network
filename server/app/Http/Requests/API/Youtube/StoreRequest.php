<?php

namespace App\Http\Requests\API\Youtube;

use Illuminate\Foundation\Http\FormRequest;

class StoreRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'user_id' => 'required',
            'title' => 'required|string',
            'url' => 'required|string'
        ];
    }
}
