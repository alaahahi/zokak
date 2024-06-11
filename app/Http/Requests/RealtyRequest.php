<?php

namespace App\Http\Requests;

class RealtyRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            'name'=> 'required|max:255',
            'city_id'=> 'nullable|numeric',
            'governorate_id'=>'nullable|numeric',
            'space' =>'nullable|string',
            'price'=> 'nullable|numeric',
            'room'=> 'nullable|numeric',
            'bathroom' => 'nullable|numeric',
            'content' => 'nullable|string|max:2000',
            'phone_contact' => 'nullable|string',
            'lng' => 'nullable|string',
            'lat' => 'nullable|string',
            'property_id' => 'nullable|numeric',
        ];
    }

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * @return array
     * Custom validation message
     */
    public function messages(): array
    {
        return [
            'name.required' => 'Please give Realty name',
            'name.max' => 'Please Realty max char name not valid',
            'city_id.numeric' => 'Please give Realty city id  valid',
            'governorate_id.numeric' => 'Please give Realty governorate id valid',
            'space.string' => 'Please give Realty space valid',
            'price.numeric' => 'Please give Realty price valid',
            'room.numeric' => 'Please give Realty room valid',
            'bathroom.numeric' => 'Please give Realty bathroom valid',
            'content.string' => 'Please give Realty content valid',
            'content.max' => 'Please Realty max char content not valid',
            'phone_contact.string' => 'Please give Realty phone contact valid',
            'lng.string' => 'Please give Realty longitude valid',
            'lat.string' => 'Please give Realty latitude valid',
            'property_id.numeric' => 'Please give Realty property id valid',
        ];
    }
}
