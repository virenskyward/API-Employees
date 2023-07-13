<?php

namespace App\Http\Repositories;

use App\Models\Role;
use Illuminate\Support\Facades\DB;

class RoleRepository
{

    public function list() {
        
        try {
                $role = [];
                
                DB::transaction(function () use (&$role) {
                    
                    $role = Role::select('id', 'role_name')->get();
                    
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
                
                DB::transaction(function () use ($data) {
                    
                    Role::create([
                        'role_name' => $data['role_name'],
                        'created_by' => 1,
                        'created_at' => getCurrentDateTime()
                    ]);

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
                    
                    Role::where(['role_id' => $id])->update([
                        'role_name' => $data['role_name'],
                        'updated_by' => 1,
                        'updated_at' => getCurrentDateTime()
                    ]);

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
                    
                    $role = Role::find($id);
                    
                    $role->deleted_by = 1;
                    $role->save();

                    $role->delete();
                    
                });

            return true;

        } catch (\Exception $e) {
            
            error_log($e->getMessage());
            throw $e;
        }

    }
}