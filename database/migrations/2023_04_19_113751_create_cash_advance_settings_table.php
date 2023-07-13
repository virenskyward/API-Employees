<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCashAdvanceSettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cash_advance_settings', function (Blueprint $table) {
            $table->integer('cash_advance_setting_id')->autoIncrement();
            $table->float('cash_advance_amount')->comment('Max amount for Cash Advance');
            $table->float('cash_advance_percentage')->comment('Max % of paycheck for Cash Advance (In %)');
            $table->float('cash_advance_no_of_paychecks')->comment('Max no. of paychecks to deduct Cash Advance amount');
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
        Schema::dropIfExists('cash_advance_settings');
    }
}
