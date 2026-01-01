<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ClientRequest extends FormRequest
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
        $validation = [
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:clients,email',
            'phone' => 'required|number|max:11|min:10',
            'ic' => 'required|number|max:12|min:12',
            'passport' => 'required|string|max:12',
            'address_1' => 'required|string|max:150',
            'address_2' => 'nullable|string|max:150',
            'address_3' => 'nullable|string|max:150',
            'city' => 'required|string|max:150',
            'state' => 'required|string|max:150',
            'zip' => 'required|number|max:5',
        ];

        if ($this->passport !== null ||
            $this->passport !== '' ||
            $this->passport !== 'N/A') {
            $validation['country'] = 'required|string|max:150';
        }

        return $validation;
    }

    // public function attributes(): array
    // {
    //     return [
    //         'name' => 'Name',
    //         'email' => 'Email',
    //         'phone' => 'Phone',
    //     ];
    // }
}
