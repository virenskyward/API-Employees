<?php

namespace App\Http\Services;

use App\Http\Repositories\ShiftSchedulerRepository;
use DateTime;
use Illuminate\Http\Response;
use Illuminate\Support\Str;

class ShiftSchedulerService
{

    private $shiftSchedulerRepository;

    public function __construct(ShiftSchedulerRepository $shiftSchedulerRepository)
    {
        $this->shiftSchedulerRepository = $shiftSchedulerRepository;
    }

    public function setShiftScheduler($input)
    {
        try {
            $shiftStartTime2 = new DateTime('0000-00-00 ' . date("H:i", strtotime($input['shift_start_time'])));
            $shiftEndTime2 = new DateTime('0000-00-00 ' . date("H:i", strtotime($input['shift_end_time'])));
            $interval = date_diff($shiftEndTime2, $shiftStartTime2);
            $totHrs = $interval->format('%h:%i');

            $data = [
                'shift_scheduler_uid' => Str::upper(Str::random(10)),
                'employee_id' => $input['employee_id'],
                'shift_date' => $input['shift_date'],
                'shift_start_time' => $input['shift_start_time'],
                'shift_end_time' => $input['shift_end_time'],
                'shift_total_time' => $totHrs,
                'created_from' => request()->header('terminal-id'),
                'created_by' => 1,
                'created_at' => getCurrentDateTime(),
            ];

            $shiftData = $this->shiftSchedulerRepository->setShiftScheduler($data);

            return [
                'status' => true,
                'message' => __('messages.common.create', ['module' => __('messages.module.hrms.shift_scheduler')]),
                'code' => Response::HTTP_OK,
                'data' => $shiftData,
            ];
        } catch (\Exception $e) {

            error_log($e->getMessage());
            throw $e;
        }
    }

    public function getShiftScheduler($input)
    {
        try {

            $result = $this->shiftSchedulerRepository->getShiftScheduler($input);

            $data = [
                'shift_scheduler' => $result->items(),
                'limit' => $result->perPage(),
                'total' => $result->total(),
                'lastPage' => $result->lastPage(),
                'currentPage' => $result->currentPage(),
            ];
            return [
                'status' => true,
                'message' => __('messages.common.list', ['module' => __('messages.module.hrms.shift_scheduler')]),
                'code' => Response::HTTP_OK,
                'data' => $data,
            ];
        } catch (\Exception $e) {

            error_log($e->getMessage());
            throw $e;
        }
    }

    public function copyShiftScheduler($input)
    {
        try {
            $input['btn_type'] = 'previous_week';
            $input['limit'] = 100;
            $shiftData = $this->shiftSchedulerRepository->getShiftScheduler($input);

            if (isset($shiftData) && !empty($shiftData)) {
                $copyData = [];
                foreach ($shiftData as $data) {
                    foreach ($data['shiftScheduler'] as $data) {

                        $nextShiftDate = date('Y-m-d', strtotime("+7 day", strtotime($data['shift_date'])));

                        $copyData[] = [
                            'shift_scheduler_uid' => Str::upper(Str::random(10)),
                            'employee_id' => $data['employee_id'],
                            'shift_date' => $nextShiftDate,
                            'shift_start_time' => $data['shift_start_time'],
                            'shift_end_time' => $data['shift_end_time'],
                            'shift_total_time' => $data['shift_total_time'],
                            'created_from' => request()->header('terminal-id'),
                            'created_by' => 1,
                            'created_at' => getCurrentDateTime(),
                        ];
                    }
                }
                $result = $this->shiftSchedulerRepository->copyShiftScheduler($copyData);
            }

            return [
                'status' => true,
                'message' => __('messages.common.create', ['module' => __('messages.module.hrms.shift_scheduler')]),
                'code' => Response::HTTP_OK,
                'data' => $result,
            ];
        } catch (\Exception $e) {

            error_log($e->getMessage());
            throw $e;
        }
    }

    public function copyShiftToWeek($input)
    {
        try {
            if (isset($input['shift_data']) && !empty($input['shift_data'])) {
                $copyData = [];
                foreach ($input['shift_data'] as $data) {
                    $copyData[] = [
                        'shift_scheduler_uid' => Str::upper(Str::random(10)),
                        'employee_id' => $input['employee_id'],
                        'shift_date' => $data['shift_date'],
                        'shift_start_time' => $data['shift_start_time'],
                        'shift_end_time' => $data['shift_end_time'],
                        'shift_total_time' => $data['shift_total_time'],
                        'created_from' => request()->header('terminal-id'),
                        'created_by' => 1,
                        'created_at' => getCurrentDateTime(),
                    ];
                }
                $result = $this->shiftSchedulerRepository->copyShiftToWeek($copyData);
            }

            return [
                'status' => true,
                'message' => __('messages.common.create', ['module' => __('messages.module.hrms.copy_shift_to_week')]),
                'code' => Response::HTTP_OK,
                'data' => $result,
            ];
        } catch (\Exception $e) {
            throw $e;
        }
    }
}