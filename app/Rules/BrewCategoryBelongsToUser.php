<?php

namespace App\Rules;

use App\Models\BrewCategory;
use App\Models\User;
use Closure;
use Illuminate\Contracts\Validation\InvokableRule;
use Illuminate\Translation\PotentiallyTranslatedString;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class BrewCategoryBelongsToUser implements InvokableRule
{

    /**
     * At that point user is authenticated.
     *
     * Run the validation rule.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @param  Closure(string): PotentiallyTranslatedString  $fail
     * @return void
     */
    public function __invoke($attribute, $value, $fail): void
    {
        try {
            if (
                auth()->user()?->getAttribute(User::COLUMN_ID) !==
                BrewCategory::findOrFail($value)?->getAttribute('user')?->getAttribute(User::COLUMN_ID)
            ) {
                $fail('The user does not own given brew category.');
            }
        } catch ( NotFoundHttpException $e ) {
            $fail('Brew category does not exist.');
        } catch ( \Exception $e ) {
            // TODO: #LogError Logging needed
            $fail('Error occurred, we are investigating it.');
        }
    }
}
