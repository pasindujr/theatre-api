<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Knuckles\Scribe\Attributes\BodyParam;

/**
 * @bodyParam seats string required The seat IDs should be separated by comma. Example: 43,45,10
 *
 */
class AllocateSeatRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'seats' => 'required',
        ];
    }

    public function authorize(): bool
    {
        return true;
    }
}
