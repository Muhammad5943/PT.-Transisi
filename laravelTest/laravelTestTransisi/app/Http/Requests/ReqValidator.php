<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

abstract class ReqValidator extends FormRequest
{
    /**
     * Overide ValidationException
     * Parameters did not pass validation
     *
     * @param ValidationException $exception
     * @return \Illuminate\Http\Response 400
     */
    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response()->json([
            'success' => false,
            'status_code' => 422,
            'message' => 'The given data was invalid',
            'errors' => $validator->errors()
        ],422));

    }

    protected function addRequired($validateRules, $except = []) {
        foreach($validateRules as $key=>$n){
            if(in_array($key,$except) && !empty($except)){
                continue;
            }
            else{
                $validateRules[$key] = $n.'|required';
            }
        }
        return $validateRules;
    }
}
