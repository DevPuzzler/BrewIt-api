<?php

namespace App\Http\Requests\BrewCategory;

use App\Http\Traits\RequestWithIdTrait;
use App\Models\BrewCategory;
use App\Rules\BrewCategoryBelongsToUser;
use Illuminate\Foundation\Http\FormRequest;

class UpdateBrewCategoryRequest extends FormRequest
{
    use RequestWithIdTrait;

    public function rules(): array
    {
        return [
            BrewCategory::COLUMN_ID => [
              'required',
              'int',
              'exists:' . BrewCategory::TABLE_NAME,
              new BrewCategoryBelongsToUser()
            ],
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
