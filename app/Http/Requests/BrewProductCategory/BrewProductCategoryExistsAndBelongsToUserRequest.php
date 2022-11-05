<?php

namespace App\Http\Requests\BrewProductCategory;

use App\Http\Traits\RequestWithIdTrait;
use App\Models\BrewProductCategory;
use App\Rules\BrewProductCategoryBelongsToUser;
use Illuminate\Foundation\Http\FormRequest;

class BrewProductCategoryExistsAndBelongsToUserRequest extends FormRequest
{
    use RequestWithIdTrait;

    public function rules(): array
    {
        return [
            BrewProductCategory::COLUMN_ID => [
                'required',
                'int',
                'exists:' . BrewProductCategory::TABLE_NAME,
                new BrewProductCategoryBelongsToUser()
            ]
        ];
    }
}
