<?php

namespace App\Http\Services;

use App\Http\Repositories\PermissionModuleRepository;
use Illuminate\Http\Response;

class PermissionModuleService
{

    public $permissionModuleRepository;

    public function __construct(PermissionModuleRepository $permissionModuleRepository)
    {
        $this->permissionModuleRepository = $permissionModuleRepository;
    }

    function list($input) {

        try {

            $result = $this->permissionModuleRepository->list($input);

            return [
                'status' => true,
                'message' => __('messages.common.list', ['module' => __('messages.module.hrms.permission_module')]),
                'code' => Response::HTTP_OK,
                'httpCode' => Response::HTTP_OK,
                'data' => [
                    'roles' => [
                        'permissionModuleList' => $result->items(),
                        'limit' => $result->perPage(),
                        'total' => $result->total(),
                        'lastPage' => $result->lastPage(),
                        'currentPage' => $result->currentPage(),
                    ],
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
                'permission_module_name' => $input['permission_module_name'],
                'permission_module_status' => $input['permission_module_status'] ?? 1,
                'created_by' => 1,
                'created_at' => getCurrentDateTime(),
            ];

            $this->permissionModuleRepository->insert($data);

            return [
                'status' => true,
                'message' => __('messages.common.create', ['module' => __('messages.module.hrms.permission_module')]),
                'code' => Response::HTTP_OK,
                'httpCode' => Response::HTTP_OK,
            ];

        } catch (\Exception $e) {

            error_log($e->getMessage());
            throw $e;
        }

    }

    public function update($input, $id)
    {

        try {
            $data = [
                    'permission_module_name' => $input['permission_module_name'],
                    'permission_module_status' => $input['permission_module_status'],
                    'updated_by' => 1,
                    'updated_at' => getCurrentDateTime(),
            ];

            $this->permissionModuleRepository->update($data, $id);

            return [
                'status' => true,
                'message' => __('messages.common.update', ['module' => __('messages.module.hrms.permission_module')]),
                'code' => Response::HTTP_OK,
                'httpCode' => Response::HTTP_OK,
            ];

        } catch (\Exception $e) {

            error_log($e->getMessage());
            throw $e;
        }

    }

    public function delete($id)
    {

        try {

            $this->permissionModuleRepository->delete($id);

            return [
                'status' => true,
                'message' => __('messages.common.delete', ['module' => __('messages.module.hrms.permission_module')]),
                'code' => Response::HTTP_OK,
                'httpCode' => Response::HTTP_OK,
            ];

        } catch (\Exception $e) {

            error_log($e->getMessage());
            throw $e;
        }

    }

}
