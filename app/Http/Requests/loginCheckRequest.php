<?php

namespace App\Http\Requests;


class loginCheckRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            'code'    => 'required|digits:4',
            'email'    => 'required',
        ];
    }

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Custom validation message
     *
     * @return array
     */
    public function messages(): array
    {
        return [
            'code.required'    => 'Please give your code',
            'code.min' => 'Please give your code  4 number',
            'email.required'    => 'Please give your phone',
        ];
    }
}
