<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateAddressRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        $user = $this->user();
        if ($user != null && $user->tokenCan('user')) {
            return true;
        }

        return false;
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
                'name' => ['required', 'string'],
                'phoneNo' => ['required', 'string'],
                'address' => ['required', 'string'],
                'city' => ['required', 'string'],
                'pincode' => ['required', 'string','max:6'],
                'state' => ['required', 'string'],
                'area' => ['required', 'string'],
            ];
        }else {
            return [
                'name' => ['sometimes','required', 'string'],
                'phoneNo' => ['sometimes','required', 'string'],
                'address' => ['sometimes','required', 'string'],
                'city' => ['sometimes','required', 'string'],
                'pincode' => ['sometimes','required', 'string','max:6'],
                'state' => ['sometimes','required', 'string'],
                'area' => ['sometimes','required', 'string'],
            ];
        }
       
    }

    protected function prepareForValidation()
    {
        if($this->phoneNo){
            $this->merge([
                'phone_no' => $this->phoneNo,
            ]);
        }
        
    }
}
