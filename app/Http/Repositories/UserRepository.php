<?php

namespace App\Http\Repositories;

use App\Models\User;
use Illuminate\Support\Facades\DB;

class UserRepository
{
    public function create($data)
    {

        try {

            $userData = '';
            DB::transaction(function () use ($data, &$userData) {

                $userData = User::create($data);

            });

            return $userData;

        } catch (\Exception $e) {

            error_log($e->getMessage());
            throw $e;
        }
    }

    public function update($data, $userId)
    {

        try {

            $userData = '';
            DB::transaction(function () use ($data, $userId, &$userData) {

                User::where('user_id', $userId)->update($data);
                $userData = User::where('user_id', $userId)->first();
            });

            return $userData;

        } catch (\Exception $e) {

            error_log($e->getMessage());
            throw $e;
        }
    }

    public function list($input)
    {

        try {

            return User::with(['roles' => function($query) {
                $query->select(['role_id', 'role_name', 'role_slug', 'role_status']);
            }])->paginate($input['limit']);

        } catch (\Exception $e) {

            error_log($e->getMessage());
            throw $e;
        }
    }

    public function destroy($id)
    {
        try {

            DB::transaction(function () use ($id) {

                $user = User::find($id);

                $user->deleted_by = 1;
                $user->save();

                $user->delete();

            });

            return true;

        } catch (\Exception $e) {

            error_log($e->getMessage());
            throw $e;
        }

    }
}