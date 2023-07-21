<?php

namespace App\Http\Services;

use App\Http\Repositories\leaveRequestRepository;
use Illuminate\Http\Response;
use Illuminate\Support\Str;

class LeaveRequestService
{

    private $leaveRequestRepository;

    public function __construct(LeaveRequestRepository $leaveRequestRepository)
    {
        $this->leaveRequestRepository = $leaveRequestRepository;
    }

    public function createLeaveRequest($input)
    {
        try {

            $data = [
                'leave_request_uid' => Str::upper(Str::random(10)),
                'employee_id' => $input['employee_id'],
                'leave_type' => $input['leave_type'],
                'leave_status' => 0,
                'leave_day' => $input['leave_day'],
                'leave_start_date' => $input['leave_start_date'],
                'leave_end_date' => $input['leave_end_date'] ?? null,
                'leave_notes' => $input['leave_notes'] ?? null,
                'hours_requested'=> $input['hours_requested'] ?? null,
                'requested_day' => $input['requested_day'],
                'leave_reason' => $input['leave_reason'],
                'created_from' => request()->header('terminal_id'),
                'created_at' => getCurrentDateTime(),
                'created_by' => $input['employee_id'],
            ];

            $data = $this->leaveRequestRepository->create($data);

            return [
                'status' => true,
                'message' => __('messages.common.create', ['module' => __('messages.module.hrms.leave_request')]),
                'code' => Response::HTTP_OK,
                'data' => $data
            ];
        } catch (\Exception $e) {

            error_log($e->getMessage());
            throw $e;
        }
    }

    public function updateLeaveRequest($input)
    {

        try {

            $data = [
                'leave_status' => $input['leave_status'],
                'deny_reason' => $input['deny_reason'] ?? null,
                'updated_from' => request()->header('terminal_id'),
                'updated_at' => getCurrentDateTime(),
                'updated_by' => 1,
            ];

            if ($input['leave_status'] == 1) {
                $getLeaveType = $this->leaveRequestRepository->getLeaveType($input['leave_type']);

                $leaveStatisticsData = [
                    'leave_statistic_uid' => Str::upper(Str::random(10)),
                    'employee_id' => $input['employee_id'],
                    'leave_type' => $input['leave_type'],
                    'max_leave' => $getLeaveType['max_leave'],
                    'leave_taken' => $input['requested_day'],
                    'created_from' => request()->header('terminal_id'),
                    'created_at' => getCurrentDateTime(),
                    'created_by' => $input['employee_id'],
                ];
                $this->leaveRequestRepository->createLeaveStatistics($leaveStatisticsData);

            }
            $this->leaveRequestRepository->update($data, $input['leave_request_uid']);

            return [
                'status' => true,
                'message' => __('messages.common.update', ['module' => __('messages.module.hrms.leave_request')]),
                'code' => Response::HTTP_OK,
            ];
        } catch (\Exception $e) {

            error_log($e->getMessage());
            throw $e;
        }

    }

    public function list($input)
    {

        try {

            $result = $this->leaveRequestRepository->list($input);

            $data = [
                'leave_request_list' => $result->items(),
                'limit' => $result->perPage(),
                'total' => $result->total(),
                'lastPage' => $result->lastPage(),
                'currentPage' => $result->currentPage(),
            ];

            return [
                'status' => true,
                'message' => __('messages.common.list', ['module' => __('messages.module.hrms.leave_request')]),
                'code' => Response::HTTP_OK,
                'data' => $data,
            ];

        } catch (\Exception $e) {

            error_log($e->getMessage());
            throw $e;
        }

    }

    public function destroy($id)
    {

        try {

            $this->leaveRequestRepository->destroy($id);

            return [
                'status' => true,
                'message' => __('messages.common.delete', ['module' => __('messages.module.hrms.leave_request')]),
                'code' => Response::HTTP_OK,
            ];

        } catch (\Exception $e) {

            error_log($e->getMessage());
            throw $e;
        }

    }

    public function getLeaveRequest($input)
    {

        try {

            $data = $this->leaveRequestRepository->getLeaveRequest($input);

            return [
                'status' => true,
                'message' => __('messages.common.list', ['module' => __('messages.module.hrms.leave_request')]),
                'code' => Response::HTTP_OK,
                'data' => $data,
            ];

        } catch (\Exception $e) {

            error_log($e->getMessage());
            throw $e;
        }

    }
}