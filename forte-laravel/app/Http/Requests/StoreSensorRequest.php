<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

/**
 * StoreSensorRequest: Validasi untuk membuat/update sensor
 */
class StoreSensorRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return $this->user()->isAdmin();
    }

    /**
     * Get the validation rules that apply to the request.
     */
    public function rules(): array
    {
        return [
            'latitude' => 'required|numeric|between:-90,90',
            'longitude' => 'required|numeric|between:-180,180',
            'daya' => 'nullable|numeric',
            'accelx' => 'nullable|numeric',
            'accely' => 'nullable|numeric',
            'accelz' => 'nullable|numeric',
            'zone' => 'nullable|string|max:100',
            'anomaly' => 'nullable|boolean',
            'description' => 'nullable|string|max:500',
        ];
    }

    /**
     * Get custom messages untuk validation errors
     */
    public function messages(): array
    {
        return [
            'latitude.required' => 'Latitude wajib diisi',
            'longitude.required' => 'Longitude wajib diisi',
            'latitude.numeric' => 'Latitude harus berupa angka',
            'longitude.numeric' => 'Longitude harus berupa angka',
        ];
    }
}
