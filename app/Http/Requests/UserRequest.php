<?php

namespace App\Http\Requests;

use App\Traits\ResponseTrait;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
{
    use ResponseTrait;
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
        $ruleEmail = 'email|required|unique:users,email';

        if(!empty($this->id)){
            $ruleEmail = 'email|required|unique:users,email,' . $this->id;
        }

        return [
            'name' => 'required|max:50|min:5',
            'email' =>$ruleEmail,
            'password' => 'required|min:6|max:50',
        ];
    }

    public function failedValidation(Validator $validator)
    {
        $this->parseValidatorToResponse($validator);
    }
}
