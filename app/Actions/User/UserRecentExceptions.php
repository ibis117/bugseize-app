<?php

namespace App\Actions\User;

use App\Models\User;
use Illuminate\Http\Request;
use Lorisleiva\Actions\Concerns\AsAction;

class UserRecentExceptions
{
    use AsAction;

    public function handle()
    {
        $user_id = auth()->user()->id;
        $exceptions = (User::with(['exceptions' => function ($q) {
            $q->orderBy('created_at', 'desc')->paginate(5);
        }])->find($user_id))->exceptions;
        return $exceptions;
    }

    public function asController(Request $request)
    {
        return response($this->handle(), 200);
    }
}
