<?php

namespace App\Actions\Centrifuge;


use Illuminate\Http\Request;
use Lorisleiva\Actions\Concerns\AsAction;
use Opekunov\Centrifugo\Centrifugo;

class CreateCentrifugeUserToken
{
    use AsAction;

    private Centrifugo $centrifugo;

    public function __construct(Centrifugo $centrifugo)
    {
        $this->centrifugo = $centrifugo;
    }

    public function handle()
    {
        $user = auth()->user();
        $expire = now()->addDay(15);
        $token = $this->centrifugo->generateConnectionToken($user->id, $expire, [
            'name' => $user->name,
        ]);
        return $token;
    }

    public function asController(Request $request)
    {
        return response([
            'token' => $this->handle()
        ], 200);
    }
}
