<?php

namespace App\Http\Requests\Birthdays;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class UpdateBirthdayRequest extends FormRequest
{

    public function authorize(): bool
    {
        $user = $this->user();
        return $user?->isAdmin() ?? false;
    }

    public function rules(): array
    {
        return [
            'banner_url'   => 'nullable|string',
            'intro_text'   => 'required|string',
            'main_body'    => 'required|string',
            'closing_text' => 'required|string',
            'sign_off'     => 'required|string|max:150',
        ];
    }
}
