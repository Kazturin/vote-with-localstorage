<?php

namespace App\Http\Requests;

use App\Models\Survey;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Enum;

class StoreSurveyRequest extends FormRequest
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

    protected function prepareForValidation()
    {
        $this->merge([
            'user_id' => $this->user()->id
        ]);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'title' => 'required|string|max:255',
            'image' => 'nullable|string',
            'user_id' => 'exists:users,id',
            'category_id' => 'required',
            'status' => 'required|boolean',
            'availability' => 'required|boolean',
            'description' => 'nullable|string',
            'expire_date' => 'nullable|date|after:tomorrow',
            'answers' => 'array',
        ];
    }

}
