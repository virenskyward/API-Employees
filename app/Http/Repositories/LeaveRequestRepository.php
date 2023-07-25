<?php

namespace App\Http\Repositories;

use App\Models\ChatHistory;
use App\Models\LeaveRequest;
use App\Models\LeaveStatistic;
use App\Models\LeaveType;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

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

                $terminal = LeaveRequest::whereIn('leave_request_id', explode(',',$id));
                $terminal->update(['deleted_by' => 1]);
                $terminal->delete();

            });

            return true;

        } catch (\Exception $e) {

            error_log($e->getMessage());
            throw $e;
        }

    }

    public function list($input) {

        try {

            $leaveRequest = [];
            $startDate = '';
            $endDate = '';
            if (isset($input['date_filter_type']) && !empty($input['date_filter_type'])) {
                if ($input['date_filter_type'] == 1) {
                    $startDate = Carbon::now()->startOfWeek();
                    $endDate = Carbon::now()->endOfWeek();
                }

                if ($input['date_filter_type'] == 2) {
                    $startDate = Carbon::now()->startOfMonth();
                    $endDate = Carbon::now()->endOfMonth();
                }

                if ($input['date_filter_type'] == 2) {
                    $startDate = $input['start_date'];
                    $endDate = $input['end_date'];
                }
            }

            DB::transaction(function () use ($input, &$leaveRequest, $startDate, $endDate) {
                
                $leaveRequest = LeaveRequest::with(['chat']);

                if((isset($startDate) && !empty($startDate)) && (isset($endDate) && !empty($endDate))) {
                    $leaveRequest = $leaveRequest->whereBetween('leave_start_date', [$startDate, $endDate]);
                }
                $leaveRequest =$leaveRequest->paginate($input['limit']);
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

    public function chatHistory($input)
    {

        try {

            $data = [];
            DB::transaction(function () use ($input, &$data) {
                $data = ChatHistory::create($input);
            });

            return $data;

        } catch (\Exception $e) {

            error_log($e->getMessage());
            throw $e;
        }

    }
}