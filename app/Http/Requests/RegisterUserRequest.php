<?php

namespace App\Http\Requests;

use ArondeParon\RequestSanitizer\Sanitizers\FilterVars;
use ArondeParon\RequestSanitizer\Sanitizers\Lowercase;
use ArondeParon\RequestSanitizer\Sanitizers\RemoveNumeric;
use ArondeParon\RequestSanitizer\Sanitizers\Trim;
use ArondeParon\RequestSanitizer\Traits\SanitizesInputs;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\JsonResponse;

class RegisterUserRequest extends FormRequest
{
    use SanitizesInputs;

    public function authorize() : bool
    {
        return true;
    }

    protected $sanitizers = [
        'name' => [FilterVars::class => ['filter' => FILTER_SANITIZE_STRING]],
        'email' => [Lowercase::class, Trim::class, FilterVars::class => ['filter' => FILTER_SANITIZE_EMAIL]],
        'password' => [Trim::class]
    ];

    public function rules(): array
    {
        return [
            'name' => 'required|string',
            'email' => 'required|string|email|unique:users',
            'password' => 'required|string|confirmed|min:6',
        ];
    }

    protected function failedValidation(Validator $validator) : JsonResponse
    {
        throw new HttpResponseException(response()->json($validator->errors(), 422));
    }

    public function messages(): array
    {
        return [
            'name.required' => 'Name field is required!',
            'email.required' => 'Email field is required!',
            'password.required' => 'Password field is required!',
            'password.confirmed' => 'Password credentials not match!',
            'password.min:6' => 'Password must be at least 6 characters',
            'email.unique:users' => 'This email has already been taken!',
            'email.email' => 'Wrong email format!',
        ];
    }
}
