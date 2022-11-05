<?php

namespace App\Http\Requests\BrewCategory;

use App\Http\Traits\RequestWithIdTrait;
use App\Models\BrewCategory;
use App\Rules\BrewCategoryBelongsToUser;
use Illuminate\Foundation\Http\FormRequest;

class BrewCategoryExistsAndBelongsToUserRequest extends FormRequest
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
            ]
        ];
    }
}
