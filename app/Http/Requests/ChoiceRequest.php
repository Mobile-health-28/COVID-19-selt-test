<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ChoiceRequest extends FormRequest
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
    { return [
        'label' => 'required',
       // 'question_id' => 'required|exists:questions,id',
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
        'label.required' => 'A label is required',
       // 'question.required' => 'Question id must be present',
        //'question.exists' => 'No question registered with such id',
    ];
}
}
