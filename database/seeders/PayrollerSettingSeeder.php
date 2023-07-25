<?php

namespace Database\Seeders;

use App\Models\PayrollSetting;
use Illuminate\Database\Seeder;

class PayrollerSettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        PayrollSetting::create([
            'pay_period' => 1,
            'pay_day' => 1,
            'created_from' => '128.0.0.1',
            'created_by' => 1,
            'created_at' => getCurrentDateTime(),
        ]);
    }
}