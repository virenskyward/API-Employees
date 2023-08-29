<?php

namespace App\Http\Repositories;

use App\Models\ShiftScheduler;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class ShiftSchedulerRepository
{
    public function setShiftScheduler($input)
    {
        try {

            $shiftData = [];
            DB::transaction(function () use ($input, &$shiftData) {

                $shiftData = ShiftScheduler::create($input);
            });

            return $shiftData;

        } catch (\Exception $e) {

            error_log($e->getMessage());
            throw $e;
        }
    }

    public function getShiftScheduler($input)
    {
        try {
            $today = isset($input['btn_date']) ? Carbon::parse($input['btn_date']) : Carbon::now();
            $startDate = $today->clone()->startOfWeek();
            $endDate = $today->clone()->endOfWeek();

            if (isset($input['btn_type']) && $input['btn_type'] == 'previous_week') {
                $today = isset($input['btn_date']) ? Carbon::parse($input['btn_date']) : Carbon::now();
                $startDate = ($today->clone()->startOfWeek())->clone()->subWeek();
                $endDate = ($today->clone()->endOfWeek())->clone()->subWeek();
            }

            if (isset($input['btn_type']) && $input['btn_type'] == 'next_week') {
                $today = isset($input['btn_date']) ? Carbon::parse($input['btn_date']) : Carbon::now();
                $startDate = ($today->clone()->startOfWeek())->clone()->addWeek();
                $endDate = ($today->clone()->endOfWeek())->clone()->addWeek();
            }

            $shiftData = [];
            DB::transaction(function () use ($input, &$shiftData, $startDate, $endDate) {
                $shiftData = User::with([
                    'shiftScheduler' => function ($q) use ($startDate, $endDate) {
                        $q->whereBetween('shift_date', [$startDate, $endDate]);
                        $q->with(['leaveRequest' => function ($q) use ($startDate, $endDate) {
                            $q->whereBetween('leave_start_date', [$startDate, $endDate]);
                        }]);
                    },
                ]);
                $shiftData = $shiftData->paginate($input['limit']);

            });

            return $shiftData;

        } catch (\Exception $e) {

            error_log($e->getMessage());
            throw $e;
        }
    }

    public function copyShiftScheduler($input)
    {
        try {

            $shiftData = [];
            $today = isset($input['btn_date']) ? Carbon::parse($input['btn_date']) : Carbon::now();
            $startDate = $today->clone()->startOfWeek();
            $endDate = $today->clone()->endOfWeek();

            DB::transaction(function () use ($input, &$shiftData, $startDate, $endDate) {
                $shiftData = ShiftScheduler::insert($input);

                if ($shiftData) {
                    $shiftData = ShiftScheduler::whereBetween('shift_date', [$startDate, $endDate])
                        ->where('employee_id', $input[0]['employee_id'])->get();
                }
            });

            return $shiftData;

        } catch (\Exception $e) {

            error_log($e->getMessage());
            throw $e;
        }
    }

    public function copyShiftToWeek($input)
    {
        try {
            $shiftData = [];
            $today = isset($input['btn_date']) ? Carbon::parse($input['btn_date']) : Carbon::now();
            $startDate = $today->clone()->startOfWeek();
            $endDate = $today->clone()->endOfWeek();

            DB::transaction(function () use ($input, &$shiftData, $startDate, $endDate) {
                $deletedRows = ShiftScheduler::where('employee_id', $input[0]['employee_id'])
                    ->whereDate('shift_date', '>=', $startDate)
                    ->whereDate('shift_date', '<=', $endDate)
                    ->update([
                        'deleted_by' => 1,
                        'deleted_at' => getCurrentDateTime(),
                    ]);

                $shiftData = ShiftScheduler::insert($input);

                if ($shiftData) {
                    $shiftData = ShiftScheduler::whereBetween('shift_date', [$startDate, $endDate])
                        ->where('employee_id', $input[0]['employee_id'])->get();
                }
            });

            return $shiftData;

        } catch (\Exception $e) {

            error_log($e->getMessage());
            throw $e;
        }
    }

}