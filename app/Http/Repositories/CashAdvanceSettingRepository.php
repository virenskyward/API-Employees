<?php

namespace App\Http\Repositories;

use App\Models\CashAdvanceSetting;
use Illuminate\Support\Facades\DB;

class CashAdvanceSettingRepository
{
    public function create($input)
    {

        try {

            DB::transaction(function () use ($input) {

                CashAdvanceSetting::create($input);
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

                CashAdvanceSetting::where('cash_advance_setting_id', $id)->update($input);
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

                $terminal = CashAdvanceSetting::find($id);

                $terminal->deleted_by = auth()->user()->user_id;
                $terminal->save();

                $terminal->delete();

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

            $cashAdvanceSettingData = [];

            DB::transaction(function () use ($input, &$cashAdvanceSettingData) {
                $cashAdvanceSettingData = CashAdvanceSetting::paginate($input['limit']);
            });

            return $cashAdvanceSettingData;

        } catch (\Exception $e) {

            error_log($e->getMessage());
            throw $e;
        }
    }

}