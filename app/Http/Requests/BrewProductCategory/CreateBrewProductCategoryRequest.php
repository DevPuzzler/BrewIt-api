<?php

namespace App\Http\Requests\BrewProductCategory;

use App\Models\BrewProductCategory;
use Illuminate\Foundation\Http\FormRequest;

class CreateBrewProductCategoryRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            BrewProductCategory::COLUMN_NAME => [
                'required',
                'string',
                'min:2',
            ],
            BrewProductCategory::COLUMN_DESCRIPTION => [
                'required',
                'string',
                'min:2'
            ]
        ];
    }
}
