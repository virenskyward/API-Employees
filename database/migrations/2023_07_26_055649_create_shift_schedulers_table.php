<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateShiftSchedulersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('shift_schedulers', function (Blueprint $table) {
            $table->integer('shift_scheduler_id')->autoIncrement();
            $table->string('shift_scheduler_uid')->comment('Shift schedulers uid');
            $table->integer('employee_id')->comment('Employee ID');
            $table->date('shift_date')->comment('Shift date');
            $table->time('shift_start_time')->comment('Shift start time');
            $table->time('shift_end_time')->comment('shift_end_time');
            $table->time('shift_total_time')->comment('shift_total_time = shift_start_time + shift_end_time');
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
        Schema::dropIfExists('shift_schedulers');
    }
}