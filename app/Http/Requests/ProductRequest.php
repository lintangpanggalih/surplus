<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;
use Illuminate\Validation\ValidationException;


class ProductRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => ['required', 'string', 'max:200'],
            'description' => ['required', 'string'],
            'enable' => ['required', 'boolean'],
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        $response = new Response(['errors' => $validator->errors()], 422);
        throw new ValidationException($validator, $response);
    }
}
