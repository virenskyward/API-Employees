<?php

namespace App\Http\Repositories;

use App\Models\PayrollSetting;
use Illuminate\Support\Facades\DB;

class PayrollSettingRepository
{
    public function create($input)
    {

        try {

            DB::transaction(function () use ($input) {

                PayrollSetting::create($input);
            });

            return true;

        } catch (\Exception $e) {

            error_log($e->getMessage());
            throw $e;
        }

    }

    public function update($input, $id)
    {

        try {

            DB::transaction(function () use ($input, $id) {

                PayrollSetting::where('payroll_setting_id', $id)->update($input);
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

                $payrollSetting = PayrollSetting::find($id);

                $payrollSetting->deleted_by = auth()->user()->user_id;
                $payrollSetting->save();

                $payrollSetting->delete();

            });

            return true;

        } catch (\Exception $e) {

            error_log($e->getMessage());
            throw $e;
        }

    }

    public function list($input)
    {

        try {

            $payrollSettingData = [];

            DB::transaction(function () use ($input, &$payrollSettingData) {
                $payrollSettingData = PayrollSetting::paginate($input['limit']);
            });

            return $payrollSettingData;

        } catch (\Exception $e) {

            error_log($e->getMessage());
            throw $e;
        }
    }

}
