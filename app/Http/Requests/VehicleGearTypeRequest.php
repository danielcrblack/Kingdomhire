<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class VehicleGearTypeRequest extends FormRequest
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
            'name' =>'required|unique:vehicle_gear_types,name' . ((is_null($this->vehicle_gear_type)) ? ("") : ("," . $this->vehicle_gear_type['id'])),
            'vehicle_gear_type' => 'nullable'
        ];
    }

    /**
     * Get custom messages for validator errors.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'name.unique' => 'Gear type \':input\' already exists'
        ];
    }

    /**
     * Get data to be validated from the request. From Route URL
     *
     * @return array
     */
    public function validationData()
    {
        if (method_exists($this->route(), 'parameters')) {
            $this->request->add($this->route()->parameters());
            $this->query->add($this->route()->parameters());

            return array_merge($this->route()->parameters(), $this->all());
        }

        return $this->all();
    }
}
