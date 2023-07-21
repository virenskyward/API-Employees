<?php

namespace App\Http\Repositories;

use App\Models\LeaveRequest;
use App\Models\LeaveStatistic;
use App\Models\LeaveType;
use Illuminate\Support\Facades\DB;

class LeaveRequestRepository
{
    public function create($input)
    {

        try {

            $data = [];
            DB::transaction(function () use ($input, &$data) {
                $data = LeaveRequest::create($input);
            });

            return $data;

        } catch (\Exception $e) {

            error_log($e->getMessage());
            throw $e;
        }

    }

    public function update($input, $id)
    {

        try {

            DB::transaction(function () use ($input, $id) {

                LeaveRequest::where('leave_request_uid', $id)->update($input);
            });

            return true;

        } catch (\Exception $e) {

            error_log($e->getMessage());
            throw $e;
        }

    }

    public function destroy($id)
    {
        try {

            DB::transaction(function () use ($id) {

                $terminal = LeaveRequest::find($id);

                $terminal->deleted_by = 1;
                $terminal->save();

                $terminal->delete();

            });

            return true;

        } catch (\Exception $e) {

            error_log($e->getMessage());
            throw $e;
        }

    }

    function list($input) {

        try {

            $leaveRequest = [];

            DB::transaction(function () use ($input, &$leaveRequest) {
                $leaveRequest = LeaveRequest::paginate($input['limit']);
            });

            return $leaveRequest;

        } catch (\Exception $e) {

            error_log($e->getMessage());
            throw $e;
        }
    }

    public function getLeaveType($leaveType)
    {
        
        return LeaveType::where('leave_type_id', $leaveType)->first();
    }

    public function createLeaveStatistics($data)
    {
        try {

            $leaveStatistic = [];

            DB::transaction(function () use ($data, &$leaveStatistic) {
                $leaveStatistic = LeaveStatistic::where('employee_id', $data['employee_id'])
                    ->where('leave_type', $data['leave_type'])
                    ->first();

                if (isset($leaveStatistic) && !empty($leaveStatistic)) {
                    $leaveStatistic->leave_taken = $leaveStatistic->leave_taken + $data['leave_taken'];
                    $leaveStatistic->updated_from = request()->header('terminal-id');
                    $leaveStatistic->updated_by = 1;
                    $leaveStatistic->updated_at = getCurrentDateTime();
                    $leaveStatistic->save();
                } else {
                    $leaveStatistic = LeaveStatistic::create($data);
                }

            });
            return $leaveStatistic;

        } catch (\Exception $e) {

            error_log($e->getMessage());
            throw $e;
        }
    }

    public function getLeaveRequest($input)
    {

        try {

            $leaveRequest = [];

            DB::transaction(function () use ($input, &$leaveRequest) {
                $leaveRequest = LeaveRequest::where('leave_request_uid', $input['leave_request_uid'])->first();
            });

            return $leaveRequest;

        } catch (\Exception $e) {

            error_log($e->getMessage());
            throw $e;
        }
    }
}