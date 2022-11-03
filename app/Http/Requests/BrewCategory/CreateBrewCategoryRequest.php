<?php

namespace App\Http\Requests\BrewCategory;

use App\Models\BrewCategory;
use Illuminate\Foundation\Http\FormRequest;

class CreateBrewCategoryRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            BrewCategory::COLUMN_NAME => [
                'required',
                'string',
                'min:2',
            ],
            BrewCategory::COLUMN_DESCRIPTION => [
                'required',
                'string',
                'min:2'
            ]
        ];
    }
}
