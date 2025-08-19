<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Http\Requests\ProfileRequest;
use App\Http\Requests\AddressRequest;

class ProfileWithAddressRequest extends FormRequest
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
        return array_merge(
            (new ProfileRequest())->rules(),
            (new AddressRequest())->rules()
        );
    }
    public function messages()
    {
        return array_merge(
            (new ProfileRequest())->messages(),
            (new AddressRequest())->messages()
        );
    }
}
