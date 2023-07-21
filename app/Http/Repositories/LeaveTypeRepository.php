<?php

namespace App\HTTP\Repositories;

use App\Models\LeaveType;
use Exception;
use Illuminate\Support\Facades\DB;

class LeaveTypeRepository
{
    public function allLeaveType()
    {
        try {
            $leaveType = [];
            DB::transaction(function () use (&$leaveType) {
                $leaveType = LeaveType::orderBy('leave_type_id', 'DESC')->paginate(10);
            });

            return $leaveType;
        } catch (\Exception $e) {

            error_log($e->getMessage());
            throw $e;
        }
    }
    public function singleLeaveType($leaveTypeUuid)
    {
        try {

            $leaveType = [];
            DB::transaction(function () use ($leaveTypeUuid, &$leaveType) {
                $leaveType = LeaveType::whereLeaveTypeUuid(
                    $leaveTypeUuid
                )->first();
            });

            return $leaveType;
        } catch (\Exception $e) {

            error_log($e->getMessage());
            throw $e;
        }
    }
    public function addLeaveType($data)
    {
        try {

            $leaveType = [];
            DB::transaction(function () use ($data, &$leaveType) {
                $leaveType = LeaveType::create($data);
            });

            return $leaveType;
        } catch (\Exception $e) {

            error_log($e->getMessage());
            throw $e;
        }
    }
    public function updateLeaveType($data, $leaveTypeId)
    {
        try {

            $leaveType = [];
            DB::transaction(function () use ($data, $leaveTypeId, &$leaveType) {
                $leaveType = LeaveType::where(['leave_type_id' => $leaveTypeId])
                    ->update($data);
            });

            if (!$leaveType) {
                $leaveType = [];
            } else {
                return $leaveType = LeaveType::whereLeaveTypeId($leaveTypeId)->first();
            }
        } catch (\Exception $e) {

            error_log($e->getMessage());
            throw $e;
        }
    }
    public function deleteLeaveType($leaveTypeId)
    {
        try {

            DB::transaction(function () use ($leaveTypeId) {
                LeaveType::where('leave_type_id', $leaveTypeId)->update([
                    'deleted_by' => 1,
                    'deleted_at' => now(),
                ]);
            });

            return true;
        } catch (Exception $e) {

            error_log($e->getMessage());
            throw $e;
        }
    }
}