<?php

namespace App\Http\Requests;

use App\Models\Claim;
use Illuminate\Foundation\Http\FormRequest;

class ClaimRequest extends FormRequest
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
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:'.Claim::class,
            'phone' => 'required|string|max:11|min:10',
            'ic' => 'required|string|max:12|min:12',
            'passport' => 'required|string|max:12'
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'The name field is required.',
            'email.required' => 'The email field is required.',
            'email.email' => 'The email field must be a valid email address.',
            'email.unique' => 'The email address has already been taken.',
            'phone.required' => 'The phone field is required.',
            'phone.string' => 'The phone field must be a string.',
            'phone.max' => 'The phone field must be less than 11 characters.',
            'phone.min' => 'The phone field must be at least 10 characters.',
            'ic.required' => 'The ic field is required.',
            'ic.string' => 'The ic field must be a string.',
            'ic.max' => 'The ic field must be less than 12 characters.',
            'ic.min' => 'The ic field must be at least 12 characters.',
            'passport.required' => 'The passport field is required.',
            'passport.string' => 'The passport field must be a string.',
            'passport.max' => 'The passport field must be less than 12 characters.',
        ];
    }

    // public function attributes(): array
    // {
    //     return [
    //         'name' => 'Name',
    //         'email' => 'Email',
    //     ];
    // }
}
