<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class MailRequest extends FormRequest
{
    private $image_extension = [
        'jpg', 'jpeg', 'png', 'gif', 'ai', 'svg', 'eps', 'ps'
    ];

    private $audio_extension = [
        'mp3', 'ogg', 'mpga'
    ];

    private $video_extension = [
        'mp4', 'mpeg','avi','mkv'
    ];

    private $document_extension = [
        'doc', 'docx', 'dotx', 'pdf', 'odt', 'xls', 'xlsm', 'xlsx', 'ppt', 'pptx', 'vsd'
    ];


    private function extensions()
    {
        $extensions =  array_merge($this->image_extension, $this->audio_extension, $this->video_extension, $this->document_extension);
        return implode(',', $extensions);
    }
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
        $extensions = $this->extensions();
        return [
            'sender'=>'required|email',
            'recipient'=>'required|email',
            'subject'=>'required|string',
            'text_content'=>'nullable|string',
            'html_content'=>'nullable|string',
            'attachments[].*' => "nullable|file|mimes:$extensions|max:5000",
            'attachments.*' => "nullable|file|mimes:$extensions|max:5000",
        ];
    }
}
