<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLeaveRequestsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('leave_requests', function (Blueprint $table) {
            $table->integer('leave_request_id')->autoIncrement();
            $table->string('leave_request_uid')->comment('Leave request uid');
            $table->integer('employee_id')->comment('Employee ID');
            $table->tinyInteger('leave_type')->comment('1:Sick Leave, 2:Vacation Leave, 3:Personal Leave');
            $table->tinyInteger('leave_status')->default(0)->comment('0:Pandding, 1:Approve, 2:Deny, 3:Cancelled');
            $table->tinyInteger('leave_day')->default(0)->comment('0:One day leave, 1:Multiple day leave');
            $table->dateTime('leave_start_date')->comment('Leave start date');
            $table->dateTime('leave_end_date')->nullable()->comment('Leave end date');
            $table->string('leave_notes')->nullable()->comment('Leave Note');
            $table->time('hours_requested')->nullable()->comment('Hours Requested');
            $table->integer('requested_day')->nullable()->comment('Requested Day');
            $table->string('leave_reason')->nullable()->comment('leave reason');
            $table->string('deny_reason')->nullable()->comment('Deny reason');
            $table->string('created_from')->comment('Login user IP Address');
            $table->string('updated_from')->nullable()->comment('Login user IP Address');
            $table->integer('created_by');
            $table->dateTime('created_at');
            $table->integer('updated_by')->nullable();
            $table->dateTime('updated_at')->nullable();
            $table->integer('deleted_by')->nullable();
            $table->dateTime('deleted_at')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('leave_requests');
    }
}