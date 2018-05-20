<?php
/**
 * Created by PhpStorm.
 * User: Claus Perbony
 * Date: 20/12/2017
 * Time: 15:59
 */

namespace CodeEduUser\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PermissionRequest extends FormRequest
{
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
                'permissions' => "required|array",
//                'permissions.*' => 'exists:permissions, id'
            ];
    }
}