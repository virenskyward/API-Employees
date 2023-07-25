<?php

namespace App\Http\Services;

use App\Http\Repositories\PayrollSettingRepository;
use Illuminate\Http\Response;

class PayrollSettingService
{

    private $payrollSettingRepository;

    public function __construct(PayrollSettingRepository $payrollSettingRepository)
    {
        $this->payrollSettingRepository = $payrollSettingRepository;
    }

    public function create($input)
    {
        try {

            $data = [
                'pay_period' => $input['pay_day'],
                'pay_day' => $input['pay_day'],
                'created_from' => request()->header('terminal_id'),
                'created_at' => getCurrentDateTime(),
                'created_by' => 1,//auth()->user()->user_id,
            ];

            $this->payrollSettingRepository->create($data);

            return [
                'status' => true,
                'message' => __('messages.common.create', ['module' => __('messages.module.hrms.payroll_setting')]),
                'code' => Response::HTTP_OK
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
                'pay_period' => $input['pay_day'],
                'pay_day' => $input['pay_day'],
                'updated_from' => request()->header('terminal_id'),
                'updated_at' => getCurrentDateTime(),
                'updated_by' => 1,//auth()->user()->user_id,
            ];

            $this->payrollSettingRepository->update($data, $input['payroll_setting_id']);

            return [
                'status' => true,
                'message' => __('messages.common.update', ['module' => __('messages.module.hrms.payroll_setting')]),
                'code' => Response::HTTP_OK
            ];
        } catch (\Exception $e) {

            error_log($e->getMessage());
            throw $e;
        }

    }

    public function list($input)
    {

        try {

            $result = $this->payrollSettingRepository->list($input);

            $data = [
                'payroll_setting_list' => $result->items(),
                'limit' => $result->perPage(),
                'total' => $result->total(),
                'lastPage' => $result->lastPage(),
                'currentPage' => $result->currentPage(),
            ];

            return [
                'status' => true,
                'message' => __('messages.common.list', ['module' => __('messages.module.hrms.payroll_setting')]),
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

            $this->payrollSettingRepository->destroy($id);

            return [
                'status' => true,
                'message' => __('messages.common.delete', ['module' => __('messages.module.hrms.payroll_setting')]),
                'code' => Response::HTTP_OK
            ];

        } catch (\Exception $e) {

            error_log($e->getMessage());
            throw $e;
        }

    }
}