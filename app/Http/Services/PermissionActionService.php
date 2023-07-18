<?php

namespace App\Http\Services;

use App\Http\Repositories\PermissionActionRepository;
use Illuminate\Http\Response;

class PermissionActionService
{

    public $permissionActionRepository;

    public function __construct(PermissionActionRepository $permissionActionRepository)
    {
        $this->permissionActionRepository = $permissionActionRepository;
    }

    function list($input) {

        try {

            $result = $this->permissionActionRepository->list($input);

            return [
                'status' => true,
                'message' => __('messages.common.list', ['module' => __('messages.module.permission_module')]),
                'code' => Response::HTTP_OK,
                'httpCode' => Response::HTTP_OK,
                'data' => [
                    'roles' => [
                        'permissionActionList' => $result->items(),
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
                'permission_module_id' => $input['permission_module_id'],
                'permission_action_name' => $input['permission_action_name'],
                'permission_action_label' => $input['permission_action_label'],
                'permission_action_status' => $input['permission_action_status'],
                'created_by' => 1,
                'created_at' => getCurrentDateTime(),
            ];

            $this->permissionActionRepository->insert($data);

            return [
                'status' => true,
                'message' => __('messages.common.create', ['module' => __('messages.module.hrms.permission_action')]),
                'code' => Response::HTTP_OK,
                'httpCode' => Response::HTTP_OK,
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
                'permission_module_id' => $input['permission_module_id'],
                'permission_action_name' => $input['permission_action_name'],
                'permission_action_label' => $input['permission_action_label'],
                'permission_action_status' => $input['permission_action_status'],
                'updated_by' => 1,
                'updated_at' => getCurrentDateTime(),
            ];

            $this->permissionActionRepository->update($data, $input['permission_action_id']);

            return [
                'status' => true,
                'message' => __('messages.common.update', ['module' => __('messages.module.hrms.permission_action')]),
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

            $this->permissionActionRepository->delete($id);

            return [
                'status' => true,
                'message' => __('messages.common.delete', ['module' => __('messages.module.hrms.permission_action')]),
                'code' => Response::HTTP_OK,
                'httpCode' => Response::HTTP_OK,
            ];

        } catch (\Exception $e) {

            error_log($e->getMessage());
            throw $e;
        }

    }

}