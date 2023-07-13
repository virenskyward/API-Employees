<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePermissionActionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('permission_actions', function (Blueprint $table) {
            $table->integer('permission_action_id')->autoIncrement();
            $table->integer('permission_module_id')->comment('Foreign key of permission module table');
            $table->string('permission_action_name', 255);
            $table->string('permission_action_label', 255);
            $table->tinyInteger('permission_action_status')->default(1);
            $table->integer('created_by');
            $table->dateTime('created_at');
            $table->integer('updated_by')->nullable();
            $table->dateTime('updated_at')->nullable();
            $table->integer('deleted_by')->nullable();
            $table->dateTime('deleted_at')->nullable();
            $table->foreign('permission_module_id')->references('permission_module_id')->on('permission_modules');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('permission_actions');
    }
}