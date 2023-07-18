<?php

namespace App\Http\Repositories;

use App\Models\PermissionAction;
use Illuminate\Support\Facades\DB;

class PermissionActionRepository
{

    function list($input) {

        try {
            $module = [];

            DB::transaction(function () use ($input, &$module) {

                $module = PermissionAction::select(
                    'permission_action_id', 'permission_module_id', 'permission_action_name', 'permission_action_label', 'permission_action_status'
                )->paginate($input['limit']);

            });

            return $module;

        } catch (\Exception $e) {

            error_log($e->getMessage());
            throw $e;
        }

    }

    public function insert($data)
    {

        try {

            DB::transaction(function () use ($data) {

                PermissionAction::create($data);

            });

            return true;

        } catch (\Exception $e) {

            error_log($e->getMessage());
            throw $e;
        }

    }

    public function update($data, $id)
    {

        try {
            DB::transaction(function () use ($data, $id) {

                PermissionAction::where(['permission_action_id' => $id])->update($data);

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

                $permissionModule = PermissionAction::find($id);

                $permissionModule->deleted_by = 1;
                $permissionModule->save();

                $permissionModule->delete();

            });

            return true;

        } catch (\Exception $e) {

            error_log($e->getMessage());
            throw $e;
        }

    }

}
