<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreActivityUpdateRequest extends FormRequest
{
    public function authorize(): bool
    {
        return $this->user() !== null;
    }

    public function rules(): array
    {
        return [
            'status'        => ['required', 'in:pending,done'],
            'remark'        => ['nullable', 'string', 'max:1000'],
            'activity_date' => ['nullable', 'date', 'before_or_equal:today'],
        ];
    }
}