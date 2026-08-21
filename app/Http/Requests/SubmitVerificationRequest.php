<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SubmitVerificationRequest extends FormRequest
{
    public function authorize(): bool
    {
        return $this->user() !== null;
    }

    public function rules(): array
    {
        return [
            // ICN number (individual) OR Matricule Fiscal (business) —
            // which one is decided in the controller based on the
            // logged-in user's existing IsBusinessAccount flag.
            'identity_type'    => ['required', 'in:cin,patente'],
            'identity_number'  => ['required', 'string', 'max:50'],
            'identity_photo'   => ['required', 'image', 'mimes:jpg,jpeg,png', 'max:5120'],
        ];
    }

    public function messages(): array
    {
        return [
            'identity_number.required' => 'CIN number or Matricule Fiscal is required.',
            'identity_photo.required'  => 'A photo of your ID (CIN or business document) is required.',
            'identity_photo.image'     => 'The uploaded file must be an image (jpg, jpeg, png).',
            'identity_photo.max'       => 'The image must not exceed 5MB.',
        ];
    }
}
