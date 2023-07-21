<?php

namespace App\http\Services;

use App\Http\Repositories\LeaveTypeRepository;
use Illuminate\Http\Response;

class LeaveTypeService
{

    private $leaveTypeRepository;

    public function __construct(LeaveTypeRepository $leaveTypeRepository)
    {
        $this->leaveTypeRepository = $leaveTypeRepository;
    }

    public function getAllLeaveType()
    {
        try {

            $data = $this->leaveTypeRepository->allLeaveType();

            return [
                'status' => true,
                'message' => __('messages.common.list', ['module' => __('messages.module.hrms.leave_type')]),
                'code' => Response::HTTP_OK,
                'httpCode' => Response::HTTP_OK,
                'data' => [
                    'brands_list' => $data,
                ],
            ];
        } catch (\Exception $e) {

            error_log($e->getMessage());
            throw $e;
        }
    }
    public function getSingleLeaveType($leaveTypeUuid)
    {
        try {

            $data = $this->leaveTypeRepository->singleLeaveType($leaveTypeUuid);

            return [
                'status' => true,
                'message' => __('messages.common.show', ['module' => __('messages.module.hrms.leave_type')]),
                'code' => Response::HTTP_OK,
                'httpCode' => Response::HTTP_OK,
                'data' => [
                    'brand' => $data,
                ],
            ];
        } catch (\Exception $e) {

            error_log($e->getMessage());
            throw $e;
        }
    }
    public function getAddLeaveType($input)
    {
        try {

            $data = [
                'leave_type_uuid' => $input['leave_type_uuid'],
                'leave_type' => $input['leave_type'],
                'max_leave' => $input['max_leave'],
                'leave_interval' => $input['leave_interval'],
                'leave_type_status' => $input['leave_type_status'],
                'created_from' => $input['created_from'],
                'created_by' => 1,
            ];
            $leaveTypeData = $this->leaveTypeRepository->addLeaveType($data);

            return [
                'status' => true,
                'message' => __(
                    'messages.common.create',
                    ['module' => __('messages.module.hrms.leave_type')]
                ),
                'code' => Response::HTTP_OK,
                'data' => [
                    'leave_type' => $leaveTypeData,
                ],
            ];
        } catch (\Exception $e) {

            error_log($e->getMessage());
            throw $e;
        }
    }
    public function getUpdateLeaveType($input, $leaveTypeId)
    {
        try {

            $data = [
                'leave_type' => $input['leave_type'],
                'max_leave' => $input['max_leave'],
                'leave_interval' => $input['leave_interval'],
                'leave_type_status' => $input['leave_type_status'],
                'updated_from' => $input['updated_from'],
                'updated_by' => 1,
            ];
            $leaveTypeData = $this->leaveTypeRepository->updateLeaveType($data, $leaveTypeId);

            return [
                'status' => true,
                'message' => __(
                    'messages.common.update',
                    ['module' => __('messages.module.hrms.leave_type')]
                ),
                'code' => Response::HTTP_OK,
                'data' => [
                    'coupon' => $leaveTypeData,
                ],
            ];
        } catch (\Exception $e) {

            error_log($e->getMessage());
            throw $e;
        }
    }
    public function getDeleteLeaveType($leaveTypeId)
    {
        try {
            $this->leaveTypeRepository->deleteLeaveType($leaveTypeId);

            return [
                'status' => true,
                'message' => __(
                    'messages.common.delete',
                    ['module' => __('messages.module.hrms.leave_type')]
                ),
                'code' => Response::HTTP_OK,
                'httpCode' => Response::HTTP_OK,
            ];
        } catch (\Exception $e) {

            error_log($e->getMessage());
            throw $e;
        }
    }
}