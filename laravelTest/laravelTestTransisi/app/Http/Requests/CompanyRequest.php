<?php

namespace App\Http\Requests;

use App\Http\Requests\ReqValidator;

class CompanyRequest extends ReqValidator
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
            'email' => 'string|max:150',
            'logo' => 'image|mimes:png|dimensions:max-width=100px,max-height=100px|max:2048',
            'website' => 'string|max:100'
        ];

        if($this->getMethod() == 'POST'){
            $rules = $this->addRequired($rules, ['logo']);
        }

        return $rules;
    }
}
