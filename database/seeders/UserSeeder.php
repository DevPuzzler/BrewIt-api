<?php

namespace Database\Seeders;

use App\Enums\UserRolesEnum as UserRoles;
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
            $user = User::factory()->make([
                User::COLUMN_EMAIL => $this->buildEmailForRole($role)
            ]);
            $user->save();
            $user->assignRole($role->value);
        }
    }

    private function buildEmailForRole(UserRoles $userRole): string
    {
        return sprintf('%s@%s.%s', $userRole->value, $userRole->value, $userRole->value);
    }
}
