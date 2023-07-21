<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\LeaveType;
use Illuminate\Support\Str;

class LeaveTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        LeaveType::create([
            'leave_type_uuid' => Str::upper(Str::random(10)),
            'leave_type' => 'Sick Leave',
            'max_leave' => 30,
            'leave_interval' => 'year',
            'leave_type_status' => 1,
            'created_from' => '128.0.0.1',
            'created_by' => 1,
            'created_at' => getCurrentDateTime(),
        ]);
        LeaveType::create([
            'leave_type_uuid' => Str::upper(Str::random(10)),
            'leave_type' => 'Vacation Leave',
            'max_leave' => 20,
            'leave_interval' => 'year',
            'leave_type_status' => 1,
            'created_from' => '128.0.0.1',
            'created_by' => 1,
            'created_at' => getCurrentDateTime(),
        ]);
        LeaveType::create([
            'leave_type_uuid' => Str::upper(Str::random(10)),
            'leave_type' => 'Personal Leave',
            'max_leave' => 20,
            'leave_interval' => 'year',
            'leave_type_status' => 1,
            'created_from' => '128.0.0.1',
            'created_by' => 1,
            'created_at' => getCurrentDateTime(),
        ]);
}
}