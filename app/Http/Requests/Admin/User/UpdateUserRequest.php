<?php

namespace App\Http\Requests\Admin\User;

use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class UpdateUserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return Auth::user()->isAdmin();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        $user = $this->route('user');

        return [
            'name' => ['required'],
            'email' => ['required', 'email', Rule::unique(User::class, 'email')->ignore($user->user_id, 'user_id')],
            'biograph' => ['nullable'],
            'description' => ['nullable'],
            'password' => ['nullable', 'confirmed'],
            'photo' => ['nullable', 'image', 'mimes:jpg,jpeg,png', 'max:2048']
        ];
    }
}
