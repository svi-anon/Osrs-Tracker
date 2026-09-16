<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateCharacterRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'min:1', 'max:50'],
            'attack' => ['required', 'integer', 'min:1', 'max:99'],
            'strength' => ['required', 'integer', 'min:1', 'max:99'],
            'defence' => ['required', 'integer', 'min:1', 'max:99'],
            'hitpoints' => ['required', 'integer', 'min:10', 'max:99'],
            'prayer' => ['required', 'integer', 'min:1', 'max:99'],
            'magic' => ['required', 'integer', 'min:1', 'max:99'],
            'ranged' => ['required', 'integer', 'min:1', 'max:99'],
        ];
    }
}