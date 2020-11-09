<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreUpdateStudent extends FormRequest
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
            'student_number' => 'sometimes|nullable|int|max:255',
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'coupon_balance' => 'required|integer'
        ];
    }
}
