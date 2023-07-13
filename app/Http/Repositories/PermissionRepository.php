<?php

namespace App\Http\Repositories;

use App\Models\Permission;
use Illuminate\Support\Facades\DB;

class PermissionRepository
{

    function list($input) {

        try {
            $permission = [];
            
            DB::transaction(function () use ($input, &$permission) {
                
                $permission = Permission::with(['permissionAction.permissionModule'])->where('user_id', '1')/*auth()->user()->user_id*/
                            ->paginate($input['limit']);
                
            });
            
            return $permission;

        } catch (\Exception $e) {

            error_log($e->getMessage());
            throw $e;
        }

    }

    public function insert($data)
    {

        try {

            DB::transaction(function () use ($data) {

                Permission::insert($data);

            });

            return true;

        } catch (\Exception $e) {

            error_log($e->getMessage());
            throw $e;
        }

    }

     public function delete($userID)
    {

        try {

            DB::transaction(function () use ($userID) {

                Permission::where('user_id', $userID)->delete();

            });

            return true;

        } catch (\Exception $e) {

            error_log($e->getMessage());
            throw $e;
        }

    }

    public function getPremissionByUserID($userID)
    {
        return Permission::where('user_id', $userID)->get();
    }
}
