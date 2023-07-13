<?php

namespace App\Http\Repositories;

use App\Models\User;
use Illuminate\Support\Facades\DB;

class UserRepository
{
    public function create($data)
    {

        try {

            DB::transaction(function () use ($data) {

                User::create($data);

            });

            return true;

        } catch (\Exception $e) {

            error_log($e->getMessage());
            throw $e;
        }
    }

    public function update($data, $userId)
    {

        try {

            DB::transaction(function () use ($data, $userId) {

                User::where('user_id', $userId)->update($data);

            });

            return true;

        } catch (\Exception $e) {

            error_log($e->getMessage());
            throw $e;
        }
    }

    public function list($input)
    {

        try {

            return User::select('role_id', 'first_name', 'last_name', 'email', 'phone_no',
                'gender', 'date_of_birth', 'marital_status', 'clock_status',
                'user_status'
            )->with(['roles' => function($query) {
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