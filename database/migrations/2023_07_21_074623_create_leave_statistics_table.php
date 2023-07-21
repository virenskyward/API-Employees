<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLeaveStatisticsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('leave_statistics', function (Blueprint $table) {
            $table->integer('leave_statistic_id')->autoIncrement();
            $table->string('leave_statistic_uid')->comment('leave statistic uid');
            $table->integer('employee_id')->comment('Employee ID');
            $table->tinyInteger('leave_type')->comment('1:Sick Leave, 2:Vacation Leave, 3:Personal Leave');
            $table->integer('max_leave')->comment('Max Leave');
            $table->integer('leave_taken')->nullable()->comment('Leave taken');
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
        Schema::dropIfExists('leave_statistics');
    }
}