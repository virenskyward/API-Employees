<?php

namespace App\Http\Services;

use App\Http\Repositories\PermissionRepository;
use Illuminate\Http\Response;

class PermissionService
{

    public $permissionRepository;

    public function __construct(PermissionRepository $permissionRepository)
    {
        $this->permissionRepository = $permissionRepository;
    }

    public function list($input) {

        try {

            $result = $this->permissionRepository->list($input);

            return [
                'status' => true,
                'message' => __('messages.common.list', ['module' => __('messages.module.permission')]),
                'code' => Response::HTTP_OK,
                'httpCode' => Response::HTTP_OK,
                'data' => [
                    "permissionsList" => $result->items(),
                    'limit' => $result->perPage(),
                    'total' => $result->total(),
                    'lastPage' => $result->lastPage(),
                    'currentPage' => $result->currentPage(),
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
            $userPremission = $this->permissionRepository->getPremissionByUserID($input['user_id']);

            if ($userPremission) {
                $this->permissionRepository->delete($input['user_id']);
            }

            $permissionData = [];

            foreach ($input['premissions'] as $permission) {
                $permissionData[] = [
                    'user_id' => $input['user_id'],
                    'role_id' => $permission['role_id'],
                    'permission_action_id' => $permission['permission_action_id'],
                    'created_by' => 1, //auth()->user()->user_id
                    'created_at' => getCurrentDateTime(),
                ];
            }

            $this->permissionRepository->insert($permissionData);

            return [
                'status' => true,
                'message' => __('messages.common.create', ['module' => __('messages.module.permission')]),
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

            $this->permissionRepository->delete($id);

            return [
                'status' => true,
                'message' => __('messages.common.delete', ['module' => __('messages.module.permission_module')]),
                'code' => Response::HTTP_OK,
                'httpCode' => Response::HTTP_OK,
            ];

        } catch (\Exception $e) {

            error_log($e->getMessage());
            throw $e;
        }

    }

}
