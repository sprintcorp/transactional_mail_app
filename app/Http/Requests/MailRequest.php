<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class MailRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'sender'=>'required|email',
            'recipient'=>'required|array',
            'subject'=>'required|string',
            'text_content'=>'nullable|string',
            'html_content'=>'nullable|string',
            'attachment'=>'nullable|max:10000|mimes:mp3,mp4,jpg,png,gif,docx,pdf,docs,txt,xlsx,csv,xls',
        ];
    }
}
