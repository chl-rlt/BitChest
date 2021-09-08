<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Password;

class ValidationsFormUser extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
                'name' => 'required|min:3',
                'email' => 'required|email',
                'password' => ['required', Password::min(6)->letters()->mixedCase()->numbers()],
                'password_confirm' => 'required|same:password',
                'profile_photo_path' => 'mimes:jpg,jpeg,png,csv,txt,xlx,xls,pdf|max:2048',
                'role_id' => 'required',
        ];
    }
}
