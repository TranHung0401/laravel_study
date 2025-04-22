<?php

namespace Modules\Categories\src\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CategoryRequest extends FormRequest
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
        $rules = [
            'name' => 'required|max:255',
            'slug' => 'required|max:255',
            'parent_id' => 'required|integer',
        ];

        return $rules;
    }

    public function messages() {
        return [
            'required' => __('categories::validate.required'),
            'max' => __('categories::validate.max'),
            'integer' => __('categories::validate.integer'),
        ];
    }

    public function attributes() {
        return [
            'name' => __('categories::validate.attributes.name'),
            'slug' => __('categories::validate.attributes.slug'),
            'parent_id' => __('categories::validate.attributes.parent_id')
        ];
    }
}
