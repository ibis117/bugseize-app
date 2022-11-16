<?php

namespace App\Actions\User;

use App\Attributes\Permission;
use App\Models\Role;
use App\Models\User;
use Ibis117\CrudActions\Traits\CreateAction;
use Illuminate\Support\Facades\DB;
use Lorisleiva\Actions\ActionRequest;

#[Permission(permission: 'user:create')]
class CreateUser
{
    use CreateAction;

    protected string $model = User::class;

    public function rules(): array
    {
        return [
            //
        ];
    }

    public function handle($name, $username, $email, $password, $role=null, $client_id=null)
    {
        DB::beginTransaction();
        try {
            $user = new User();
            $user->name = $name;
            $user->username = $username;
            $user->email = $email;
            $user->password = bcrypt($password);
            $user->save();
            if (@$role) {
                $user->assignRole($role);
            }

            if (@$client_id) {
                $user->clients()->sync($client_id, ['is_owner' => true, 'created_at' => now(), 'updated_at' => now()]);
            }
            DB::commit();
            return $user;
        } catch (\Exception $e) {
            DB::rollBack();
        }
    }

    public function asController(ActionRequest $request)
    {
        [
            'name' => $name,
            'username' => $username,
            'email' => $email,
            'password' => $password
        ] = $request->only(['name', 'username', 'email', 'password']);
        $role = $request->role_id ?  Role::find($request->role_id) : null;
        $client_id = $request->client_id ?? null;
        if ($data = $this->handle($name, $username, $email, $password, $role, $client_id)) {
            return response($data, 200);
        }

        return response(['message' => 'User could not be created'], 400);
    }
}
