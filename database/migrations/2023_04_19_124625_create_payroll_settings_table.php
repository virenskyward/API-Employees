<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePayrollSettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('payroll_settings', function (Blueprint $table) {
            $table->integer('payroll_setting_id')->autoIncrement();
            $table->tinyInteger('pay_period')->comment('1:Weekly, 2:Fortnightly (Bi-weekly), 3:Twice-a-month, 4:Monthly');
            $table->tinyInteger('pay_day')->comment('1:same day 2:next day 3:next business day');
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
        Schema::dropIfExists('payroll_settings');
    }
}
