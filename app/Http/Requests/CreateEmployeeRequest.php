<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateEmployeeRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'first_name'=>['required', 'string','min:3','max:100'],
            'last_name'=>['required', 'string','min:3','max:100'],
            'middle_name'=>['required', 'string','min:3','max:100'],
            'zip_code'=>['required', 'string','min:5','max:10'],
            'city_id'=>['required','exists:cities,id'],
            'department_id'=>['required','exists:departments,id'],
            'birth_date'=>['required','date'],
            'date_hired'=>['required','date']

        ];
    }
}
