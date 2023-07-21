<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLeaveTypesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('leave_types', function (Blueprint $table) {
            $table->id('leave_type_id')->autoIncrement()->comment('Leave type:id');
            $table->string('leave_type_uuid', 100)->unique()->comment('Leave: Unique id');
            $table->string('leave_type', 100)->comment('Leave: Type');
            $table->integer('max_leave')->comment('Max leave');
            $table->string('leave_interval', 100)->comment('leave duration (in: year, month, week)');
            $table->tinyInteger('leave_type_status')->default('1')->comment('1: Active, 0: Inactive');
            $table->string('created_from', 255)->comment('Login User Mac Address.');
            $table->string('updated_from', 255)->comment('Login User Mac Address.')->nullable();
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
        Schema::dropIfExists('leave_types');
    }
}
