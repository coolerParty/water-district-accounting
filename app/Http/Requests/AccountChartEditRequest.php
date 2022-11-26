<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class AccountChartEditRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules($account_id)
    {
        return [
            'code'             => ['required', 'string', Rule::unique('account_charts')->ignore($account_id)],
            'name'             => ['required', 'min:3', 'string', Rule::unique('account_charts')->ignore($account_id)],
            'acctgrp_id'       => ['required'],
            'mjracctgrp_id'    => ['required'],
            'submjracctgrp_id' => ['required'],
            'current_non'      => ['required', 'min:1', 'max:3','digits:1', 'numeric'],
        ];
    }
}
