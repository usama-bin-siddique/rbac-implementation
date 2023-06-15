<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Password;

class UpdateUserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return auth()->user()->hasRole('admin');
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'name' => ['required', 'max:255'],
            'phone' => ['required', 'numeric', 'min_digits:11', 'max_digits:13', Rule::unique('users')->ignore($this->user->id)],
            'email' => ['required', 'email:rfc,dns', Rule::unique('users')->ignore($this->user->id)],
            'password' => ['nullable','confirmed', Password::min(8)],
        ];
    }
}
