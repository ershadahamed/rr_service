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
        $validation = [
            'car_registration_number' => ['required', 'string', 'max:15'],
            'brand' => ['required', 'string', 'max:50'],
            'model' => ['required', 'string', 'max:50'],
            'policy' => ['required', 'string', 'max:150'],
            'insurance_company' => ['required', 'string', 'max:150'],
            'workshop' => ['required', 'string', 'max:150'],
            'reported_station' => ['required', 'string', 'max:150'],
            'ic_driver' => ['required', 'string', 'max:12', 'min:12'],
            'passport_driver' => ['required', 'string', 'max:12'],
            'phone_driver' => ['required', 'number', 'max:11', 'min:10'],
            'name_driver' => ['required', 'string', 'max:255'],
            'location' => ['required', 'string', 'max:150'],
            'picture_root_path' => ['required', 'string', 'max:255'],
        ];

        if ($this->passport !== null ||
            $this->passport !== '' ||
            $this->passport !== 'N/A') {
            $validation['country_driver'] = 'required|string|max:150';
        }

        return $validation;
    }

    // public function attributes(): array
    // {
    //     return [
    //         'name' => 'Name',
    //         'email' => 'Email',
    //     ];
    // }
}
