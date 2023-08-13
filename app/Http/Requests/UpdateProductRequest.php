<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateProductRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        // $user = $this->user();
        // if ($user != null && $user->tokenCan('user')) {
        //     return true;
        // }

        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        $method = $this->method();
        if ($method=='PUT') {   
            return [
                'category_id' => ['required'],
                'title' => ['required', 'string'],
                'autor' => ['required', 'string'],
                'publishDate' => ['required', 'string'],
                'description' => ['required', 'string',],
                'price' => ['required'],
                'discount' => ['required'],
                'pages' => ['required'],
                'language' => ['required', 'string'],
            ];
        }else {
            return [
                'category_id' => ['sometimes','required'],
                'title' => ['sometimes','required', 'string'],
                'autor' => ['sometimes','required', 'string'],
                'publishDate' => ['sometimes','required', 'string'],
                'description' => ['sometimes','required', 'string'],
                'price' => ['sometimes','required'],
                'discount' => ['sometimes','required'],
                'pages' => ['sometimes','required'],
                'language' => ['sometimes','required', 'string'],
            ];
        }
       
    }

    
}
