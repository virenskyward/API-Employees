<?php

namespace App\Http\Services;

use App\Http\Repositories\RoleRepository;
use Illuminate\Http\Response;

class RoleService
{

    private $roleRepository;

    public function __construct(RoleRepository $roleRepository)
    {
        $this->roleRepository = $roleRepository;
    }

    public function list($input)
    {

        try {

            $data = $this->roleRepository->list($input);

            return [
                'status' => true,
                'message' => __('messages.common.list', ['module' => __('messages.module.hrms.role')]),
                'code' => Response::HTTP_OK,
                'data' => [
                    "roles" => $data,
                ],
            ];

        } catch (\Exception $e) {

            error_log($e->getMessage());
            throw $e;
        }

    }

    public function create($input)
    {

        try {
            $data = [
                'role_name' => $input['role_name'],
                'created_by' => 1,
                'created_at' => getCurrentDateTime(),
            ];

            $roleData = $this->roleRepository->insert($data);

            return [
                'status' => true,
                'message' => __('messages.common.create', ['module' => __('messages.module.hrms.role')]),
                'code' => Response::HTTP_OK,
                'data' => $roleData
            ];

        } catch (\Exception $e) {

            error_log($e->getMessage());
            throw $e;
        }

    }

    public function update($input)
    {

        try {
            $data = [
                'role_name' => $input['role_name'],
                'updated_by' => 1,
                'updated_at' => getCurrentDateTime(),
            ];

            $this->roleRepository->update($data, $input['role_id']);

            return [
                'status' => true,
                'message' => __('messages.common.update', ['module' => __('messages.module.hrms.role')]),
                'code' => Response::HTTP_OK,
            ];

        } catch (\Exception $e) {

            error_log($e->getMessage());
            throw $e;
        }

    }

    public function delete($id)
    {

        try {

            $this->roleRepository->delete($id);

            return [
                'status' => true,
                'message' => __('messages.common.delete', ['module' => __('messages.module.hrms.role')]),
                'code' => Response::HTTP_OK,
            ];

        } catch (\Exception $e) {

            error_log($e->getMessage());
            throw $e;
        }

    }
}