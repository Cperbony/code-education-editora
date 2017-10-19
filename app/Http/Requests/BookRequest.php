<?php

namespace CodePub\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BookRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        $book = $this->route('book');
        $user = $book ? $book->id : \Auth::user()->id;
        return $user == \Auth::user()->id ? true : false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'title' => "required|max:255",
            'subtitle' => "required|max:255",
            'price' => "required|numeric"
        ];
    }
}
