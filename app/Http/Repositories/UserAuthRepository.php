<?php

namespace App\Http\Repositories;

use App\Models\UserAuthentication;
use Illuminate\Support\Facades\DB;

class UserAuthRepository
{

    public function getUserAuthData($token)
    {
        try {

            $userAuth = [];
            DB::transaction(function () use ($token, &$userAuth) {
                $userAuth = UserAuthentication::where('auth_token', $token)->first();
            });

            return $userAuth;

        } catch (\Exception $e) {

            error_log($e->getMessage());
            throw $e;
        }
    }

    public function createUserAuth($input)
    {
        try {

            DB::transaction(function () use ($input) {

                UserAuthentication::create($input);
            });

            return true;

        } catch (\Exception $e) {

            error_log($e->getMessage());
            throw $e;
        }
    }
}