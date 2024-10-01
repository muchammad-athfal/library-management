<?php

namespace App\Http\Requests\Api\V1;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class AuthorRequest extends FormRequest
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
            'name' => 'required|string',
            'bio' => 'nullable|string',
            'birth_date' => 'required|date',
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        $message = $validator->errors();
        throw new HttpResponseException(response()->json([
            'statusCode' => 422,
            'message' => 'Input validation error',
            'errors' => $message->messages()
        ], 422));
    }
}
