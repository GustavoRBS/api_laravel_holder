<?php

namespace App\Http\Requests\Transaction;

use Illuminate\Foundation\Http\FormRequest;

class TransactionRequest extends FormRequest
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
            'start_date' => 'required',
            'end_date' => 'required',
            'price_buy' => 'required',
            'price_sell' => 'required',
            'description' => 'required',
        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'start_date.required' => 'Please fill the start_date.',
            'end_date.required' => 'Please fill the end_date.',
            'price_buy.required' => 'Please fill the price_buy.',
            'price_sell.required' => 'Please fill the price_sell.',
            'description.required' => 'Please fill the description.',
        ];
    }

}
