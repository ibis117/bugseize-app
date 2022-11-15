<?php

namespace Database\Seeders;

use App\Actions\Permission\ExceptPermission;
use App\Actions\Role\CreateRole;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $role = CreateRole::run(['name' => 'client-admin']);
        $not_allowed = [
            'permission',
            'role'
        ];
        $permissions = ExceptPermission::run($not_allowed);
        $role->givePermissionTo($permissions);
    }
}
