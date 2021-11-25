<?php

namespace App\Http\Requests\API\Calendar;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class Store extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return \auth()->check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'image.name' => ['string'],
            'image.encoded' => ['string'],
            'image.ext' => ['string'],
            'description' => ['required','string'],
            'title' => ['required','string'],
            'arranged' => ['required','date_format:Y-m-d H:i:s'],
        ];
    }
}
