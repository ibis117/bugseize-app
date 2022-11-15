<?php

namespace App\Actions\User;

use App\Attributes\Permission;
use App\Models\User;
use Ibis117\CrudActions\Traits\CreateAction;
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

    public function handle($name, $username, $email, $password, $role=null)
    {
        $user = new User();
        $user->name = $name;
        $user->username = $username;
        $user->email = $email;
        $user->password = bcrypt($password);
        $user->save();
        if (@$role) {
            $user->assignRole($role);
        }
        return $user;
    }

    public function asController(ActionRequest $request)
    {
        [
            'name' => $name,
            'username' => $username,
            'email' => $email,
            'password' => $password
        ] = $request->only(['name', 'username', 'email', 'password']);
        $role = $request->role_id ?? null;
        if ($data = $this->handle($name, $username, $email, $password, $role)) {
            return response($data, 200);
        }

        return response(['message' => 'User could not be created'], 400);
    }
}
