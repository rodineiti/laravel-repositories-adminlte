<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreUpdateQuestionFormRequest extends FormRequest
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
            "title"  => "required",
            "order"  => "required|numeric",
            "choiceTitle" => "required|array",
            "choiceOrder" => "required|array",
            "choiceCorrect" => "required",
        ];
    }
}
