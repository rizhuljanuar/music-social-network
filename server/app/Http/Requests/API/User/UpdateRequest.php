<?php

declare(strict_types=1);

namespace App\Http\Requests\API\User;

use Illuminate\Foundation\Http\FormRequest;

final class UpdateRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'first_name' => 'required|string|min:3',
            'last_name' => 'required|string|min:3'
        ];
    }
}
