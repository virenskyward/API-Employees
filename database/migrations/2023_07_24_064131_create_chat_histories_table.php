<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateChatHistoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('chat_histories', function (Blueprint $table) {
            $table->integer('chat_history_id')->autoIncrement();
            $table->string('chat_history_uid')->comment('chat history uid');
            $table->integer('employee_id')->comment('Employee ID');
            $table->integer('leave_request_id')->comment('Leave Request id');
            $table->string('chat_detail')->comment('Chat detail');
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
        Schema::dropIfExists('chat_histories');
    }
}
