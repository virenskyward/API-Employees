<?php

namespace App\Http\Repositories;

use App\Models\PermissionModule;
use Illuminate\Support\Facades\DB;

class PermissionModuleRepository
{

    function list($input) {

        try {
            $module = [];

            DB::transaction(function () use ($input, &$module) {

                $module = PermissionModule::select(
                    'permission_module_id', 'permission_module_name', 'permission_module_status'
                )->with(['permissionaction'])->paginate($input['limit']);

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

                PermissionModule::create($data);

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

                PermissionModule::where(['permission_module_id' => $id])->update($data);

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

                $permissionModule = PermissionModule::find($id);

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
