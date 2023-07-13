<?php

namespace App\Http\Services;

use App\Http\Repositories\UserRepository;
use Illuminate\Http\Response;

class UserService
{

    private $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    function list($input) {

        try {

            $result = $this->userRepository->list($input);

            $data = [
                'userList' => $result->items(),
                'limit' => $result->perPage(),
                'total' => $result->total(),
                'lastPage' => $result->lastPage(),
                'currentPage' => $result->currentPage(),
            ];

            return [
                'status' => true,
                'message' => __('messages.common.list', ['module' => __('messages.module.user')]),
                'code' => Response::HTTP_OK,
                'data' => $data,
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
                'role_id' => $input['role_id'],
                'first_name' => $input['first_name'],
                'last_name' => $input['last_name'],
                'email' => $input['email'],
                'phone_no' => $input['phone_no'],
                'gender' => $input['gender'],
                'date_of_birth' => $input['date_of_birth'],
                'marital_status' => $input['marital_status'],
                'pin' => md5($input['pin']),
                'emergency_contact_number' => $input['emergency_contact_number'] ?? null,
                'emergency_contact_person' => $input['emergency_contact_person'] ?? null,
                'relationshipe' => $input['relationshipe'] ?? null,
                'registration_date' => getCurrentDateTime(),
                'created_by' => auth()->user()->user_id,
                'created_at' => getCurrentDateTime(),
            ];

            $this->userRepository->create($data);

            return [
                'status' => true,
                'message' => __('messages.common.create', ['module' => __('messages.module.user')]),
                'code' => Response::HTTP_OK,
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
                'role_id' => $input['role_id'],
                'first_name' => $input['first_name'],
                'last_name' => $input['last_name'],
                'email' => $input['email'],
                'phone_no' => $input['phone_no'],
                'gender' => $input['gender'],
                'date_of_birth' => $input['date_of_birth'],
                'marital_status' => $input['marital_status'],
                'updated_by' => auth()->user()->user_id,
                'updated_at' => getCurrentDateTime(),
                'pin' => md5($input['pin']),
                'emergency_contact_number' => $input['emergency_contact_number'] ?? null,
                'emergency_contact_person' => $input['emergency_contact_person'] ?? null,
                'relationshipe' => $input['relationshipe'] ?? null,
            ];

            $this->userRepository->update($data, $input['user_id']);

            return [
                'status' => true,
                'message' => __('messages.common.update', ['module' => __('messages.module.user')]),
                'code' => Response::HTTP_OK,
            ];

        } catch (\Exception $e) {

            error_log($e->getMessage());
            throw $e;
        }

    }

    public function destroy($id)
    {

        try {

            $this->userRepository->destroy($id);

            return [
                'status' => true,
                'message' => __('messages.common.delete', ['module' => __('messages.module.user')]),
                'code' => Response::HTTP_OK,
            ];

        } catch (\Exception $e) {

            error_log($e->getMessage());
            throw $e;
        }

    }
}