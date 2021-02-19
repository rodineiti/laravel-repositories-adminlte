<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreUpdateTestFormRequest extends FormRequest
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
            "subject_id" => "required|exists:subjects,id",
            "institution_id" => "required|exists:institutions,id",
            "teaching_unit_id" => "required|exists:teaching_units,id",
            "offer_type_id" => "required|exists:offer_types,id",
            "discipline_id" => "required|exists:disciplines,id",
            "state" => "required|max:2",
            "city" => "required",
            "year" => "required|min:4|max:4",
            "jury" => "required",
        ];
    }
}
