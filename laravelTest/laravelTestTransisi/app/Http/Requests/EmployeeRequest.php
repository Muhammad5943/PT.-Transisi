<?php

namespace App\Http\Requests;

use App\Http\Requests\ReqValidator;

class EmployeeRequest extends ReqValidator
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $rules = [
            'name' => 'string|max:100',
            'email' => 'string|email|unique:users,email',
            'company_id' => 'integer'
        ];

        if($this->getMethod() == 'POST'){
            $rules = $this->addRequired($rules);
        }

        return $rules;
    }
}
