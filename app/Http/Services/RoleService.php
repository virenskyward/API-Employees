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

    public function list() {

        try {

            $data = $this->roleRepository->list();

            return [
                'status' => true,
                'message' => __('messages.common.list', ['module' => __('messages.module.role')]),
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

            $this->roleRepository->insert($input);

            return [
                'status' => true,
                'message' => __('messages.common.create', ['module' => __('messages.module.role')]),
                'code' => Response::HTTP_OK
            ];

        } catch (\Exception $e) {

            error_log($e->getMessage());
            throw $e;
        }

    }

    public function update($input, $id)
    {

        try {

            $this->roleRepository->update($input, $id);

            return [
                'status' => true,
                'message' => __('messages.common.update', ['module' => __('messages.module.role')]),
                'code' => Response::HTTP_OK
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
                'message' => __('messages.common.delete', ['module' => __('messages.module.role')]),
                'code' => Response::HTTP_OK
            ];

        } catch (\Exception $e) {

            error_log($e->getMessage());
            throw $e;
        }

    }
}