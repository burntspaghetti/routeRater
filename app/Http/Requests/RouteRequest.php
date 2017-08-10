<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class RouteRequest extends Request
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
            'name' => 'required|max:255|unique:routes',
            'image' => 'required|image|mimes:jpeg,png,jpg|max:10000',//max filesize is 10mb
            'rating' => 'required'
        ];
    }
}
