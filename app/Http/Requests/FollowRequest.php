<?php

namespace App\Http\Requests;
use Illuminate\Support\Facades\Auth;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Log;

class FollowRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        Log::info(auth()->check());
        return auth()->check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'userName' => 'required|string',
        ];
    }
}