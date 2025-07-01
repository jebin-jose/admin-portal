<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class StoreCustomFieldRequest extends FormRequest
{

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        $rules = [
            'module' => 'required|in:customer,invoice',
            'name' => 'required|string|max:255',
            'type' => 'required|in:text,date,decimal,dropdown,lookup',
            'is_required' => 'nullable|boolean',
            'lookup_module' => 'nullable|string|in:customer,invoice',
        ];

        // Only validate options if type is dropdown
        if ($this->type === 'dropdown') {
            $rules['options'] = 'required|array|min:1';
            $rules['options.*'] = 'required|string|max:255';
        }

        // Only validate lookup_module if type is lookup
        if ($this->type === 'lookup') {
            $rules['lookup_module'] = 'required|string|in:customer,invoice';
        }

        return $rules;
    }
}
