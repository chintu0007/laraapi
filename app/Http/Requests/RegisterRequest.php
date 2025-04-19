<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'data.attributes.name'  => 'required|string',
            'data.attributes.email' => 'required|email|string|unique:users,email',
            'data.attributes.username' => 'required|string|unique:users,username',
            'data.attributes.password' => 'required|string|min:6|confirmed'
        ];
    }

    public function userData(): array
    {
        $data = $this->input('data.attributes');
        $data['password'] = bcrypt($data['password']);
        unset($data['password_confirmation']);
        return $data;
    }
}
