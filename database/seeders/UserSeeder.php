<?php

namespace Database\Seeders;

use App\Actions\Client\CreateClient;
use App\Actions\Permission\SyncPermission;
use App\Actions\Role\CreateRole;
use App\Actions\User\CreateUser;
use App\Models\Permission;
use App\Models\Role;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $client = CreateClient::run(['name' => 'System']);
        SyncPermission::run();
        $permissions = Permission::all();
        $role = Role::create(['name' => 'super-admin'])->first();
        $role->syncPermissions($permissions);
        $user = CreateUser::run('SuperAdmin', 'superadmin', 'cresilsanil@gmail.com', 'password1', $role);
        $user->email_verified_at = now();
        $user->save();
        $user->clients()->attach($client->id, ['is_super_admin' => true, 'created_at' => now(), 'updated_at' => now()]);
    }
}
