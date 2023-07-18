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

    public function getPermisionAction()
    {
        $permissionActions =  \App\Models\PermissionAction::select('permission_action_name')
                                ->where('permission_action_status', 1)
                                ->get()->toArray();
                                
        return !empty($permissionActions) ? array_column($permissionActions, 'permission_action_name') : [];
    }

    public function getUserPermisstionAcction($userId)
    {
        $permissions =  Permission::with(['permissionAction' => function ($query) {
                            $query->select('permission_action_id','permission_action_name');
                        }])->where('user_id', $userId)
                        ->get()->toArray();
        $permissionActionNames = array_column($permissions, 'permission_action');

        return  array_column($permissionActionNames, 'permission_action_name');
    }
}