<?php

namespace App\Http\Requests;

use App\Http\Resources\ErrorResource;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class BaseFormRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize():bool
    {
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules():array
    {
        return [
            //
        ];
    }


    /**
     * @param Validator $validator
     * @return void
     */
    protected function failedValidation(Validator $validator):void
    {
        throw new HttpResponseException(response(new ErrorResource($validator->errors()->first())));
    }
}
