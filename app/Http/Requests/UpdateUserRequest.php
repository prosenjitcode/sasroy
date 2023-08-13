<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateUserRequest extends FormRequest
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

        return [
            'name' => ['string','required'],
            //'avatar' => 'required|image|mimes:jpg,png,jpeg,gif,svg|max:2048',
        ];
    }



    // protected function prepareForValidation()
    // {

    //     $this->merge([
    //        // 'image_url' => $this->avatar,
    //     ]);
    // }
}
