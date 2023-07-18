<?php

namespace App\Http\Repositories;

use App\Models\Role;
use Illuminate\Support\Facades\DB;

class RoleRepository
{

    public function list($input)
    {

        try {
            $role = [];

            DB::transaction(function () use (&$role, $input) {

                $role = Role::paginate($input['limit']);

            });

            return $role;

        } catch (\Exception $e) {

            error_log($e->getMessage());
            throw $e;
        }

    }

    public function insert($data)
    {

        try {

            $roleData = [];
            DB::transaction(function () use ($data, &$roleData) {

                $roleData = Role::create($data);

            });

            return $roleData;

        } catch (\Exception $e) {

            error_log($e->getMessage());
            throw $e;
        }

    }

    public function update($data, $id)
    {

        try {

            DB::transaction(function () use ($data, $id) {

                Role::where(['role_id' => $id])->update($data);

            });

            return true;

        } catch (\Exception $e) {

            error_log($e->getMessage());
            throw $e;
        }

    }

    public function delete($id)
    {

        try {

            DB::transaction(function () use ($id) {

                $role = Role::whereIn('role_id', explode(',',$id));
                $role->update(['deleted_by' => 1]);
                $role->delete();

            });

            return true;

        } catch (\Exception $e) {

            error_log($e->getMessage());
            throw $e;
        }

    }
}