<?php

namespace App\Http\Services;

use App\Http\Repositories\CashAdvanceSettingRepository;
use Illuminate\Http\Response;

class CashAdvanceSettingService
{

    private $cashAdvanceSettingRepository;

    public function __construct(CashAdvanceSettingRepository $cashAdvanceSettingRepository)
    {
        $this->cashAdvanceSettingRepository = $cashAdvanceSettingRepository;
    }

    public function create($input)
    {
        try {

            $data = [
                'cash_advance_amount' => $input['cash_advance_amount'],
                'cash_advance_percentage' => $input['cash_advance_percentage'],
                'cash_advance_no_of_paychecks' => $input['cash_advance_no_of_paychecks'],
                'created_from' => request()->header('terminal_id'),
                'created_at' => getCurrentDateTime(),
                'created_by' => auth()->user()->user_id,
            ];

            $this->cashAdvanceSettingRepository->create($data);

            return [
                'status' => true,
                'message' => __('messages.common.create', ['module' => __('messages.module.cash_advance_settings')]),
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
                'cash_advance_amount' => $input['cash_advance_amount'],
                'cash_advance_percentage' => $input['cash_advance_percentage'],
                'cash_advance_no_of_paychecks' => $input['cash_advance_no_of_paychecks'],
                'updated_from' => request()->header('terminal_id'),
                'updated_at' => getCurrentDateTime(),
                'updated_by' => auth()->user()->user_id,
            ];

            $this->cashAdvanceSettingRepository->update($data, $input['cash_advance_setting_id']);

            return [
                'status' => true,
                'message' => __('messages.common.update', ['module' => __('messages.module.cash_advance_settings')]),
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

            $result = $this->cashAdvanceSettingRepository->list($input);

            $data = [
                'cash_advance_setting_list' => $result->items(),
                'limit' => $result->perPage(),
                'total' => $result->total(),
                'lastPage' => $result->lastPage(),
                'currentPage' => $result->currentPage(),
            ];

            return [
                'status' => true,
                'message' => __('messages.common.list', ['module' => __('messages.module.cash_advance_settings')]),
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

            $this->cashAdvanceSettingRepository->destroy($id);

            return [
                'status' => true,
                'message' => __('messages.common.delete', ['module' => __('messages.module.cash_advance_settings')]),
                'code' => Response::HTTP_OK,
            ];

        } catch (\Exception $e) {

            error_log($e->getMessage());
            throw $e;
        }

    }
}