<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreLeadRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:255'], //
            'email' => ['required', 'string', 'max:255'], //
            'propertyType' => ['required', 'string', 'max:255'],
            'estimatedWorth' => ['required', 'string', 'max:255'], //
            'timeline' => ['required', 'string', 'max:255'],
            'bedroomCount' => ['required', 'string', 'max:255'],
            'bathroomCount' => ['required', 'string', 'max:255'],
            'shouldReceiveOffer' => ['required', 'string', 'max:255'],
        ];
    }
}
