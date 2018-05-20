<?php

namespace CodeEduUser\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
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
        $id = $this->route('user');

        return [
            'name' => "required|max:255",
            'email' => "required|max:255|unique:users,email, {$id}",
            'roles.*' => 'exists:roles,id'
        ];
    }
}
