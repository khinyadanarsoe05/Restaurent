<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreDishRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return  true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
        'name' => 'required|max:255',
        'category_id' => 'required',
       //'dish_image' => 'required',

        ];
         if ($this->isMethod('post')) {
        // Require image only when creating
        $rules['dish_image'] = 'required|image|mimes:jpeg,png,jpg,gif|max:2048';
    } else {
        // Optional on update
        $rules['dish_image'] = 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048';
    }

    return $rules;
    }

}
