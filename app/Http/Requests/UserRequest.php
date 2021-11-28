<?php

namespace App\Http\Requests;

use App\Actions\Fortify\PasswordValidationRules;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class UserRequest extends FormRequest
{
    use PasswordValidationRules;
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return Auth::check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
                'name' => 'required|string|max:255',
                'password' => ['required',$this->passwordRules()],
                'username' => 'required|string|max:255',
                'email' => 'required|string|max:255|unique:users',
                'profile_photo_path' => 'required|image',
                'role_id' => 'required|string|max:255|in:1,2,3',
                'phone' => 'nullable|string|max:255',
        ];
    }
}
