<?php

namespace Database\Seeders;

use App\Enums\UserRolesEnum as UserRoles;
use App\Models\BrewCategory;
use App\Models\BrewProduct;
use App\Models\BrewProductCategory;
use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void
    {
        foreach( UserRoles::cases() as $role ) {
            $user = User::factory()
                ->state([
                    User::COLUMN_EMAIL => $this->buildEmailForRole($role)
                ])
                ->has(
                    BrewProductCategory::factory()
                        ->count(2)
                        ->state(function(array $attributes, User $user) {
                            return [ BrewCategory::COLUMN_USER_ID => $user->getAttribute(User::COLUMN_ID)];
                        })
                        ->has(BrewProduct::factory()
                            ->count(3)
                            ->state( function(array $attributes, BrewProductCategory $brewProductCategory)  {
                                return [
                                    BrewProduct::COLUMN_USER_ID =>
                                        $brewProductCategory->getAttribute(BrewProductCategory::COLUMN_USER_ID),
                                    BrewProduct::COLUMN_PRODUCT_CATEGORY_ID =>
                                        $brewProductCategory->getAttribute(BrewProductCategory::COLUMN_ID)
                                ];
                            }), 'brewProducts',
                    ), 'brewProductCategories'
                )
                ->create();
            $user->save();
            $user->assignRole($role->value);
        }
    }

    private function buildEmailForRole(UserRoles $userRole): string
    {
        return sprintf('%s@%s.%s', $userRole->value, $userRole->value, $userRole->value);
    }
}
