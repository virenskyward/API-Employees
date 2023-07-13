<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnToUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('emergency_contact_person')->after('pin')->nullable()->comment('Emergency Contact Person');
            $table->string('emergency_contact_number')->after('emergency_contact_person')->nullable()->comment('Emergency Contact Person');
            $table->string('relationshipe')->after('emergency_contact_number')->nullable()->comment('Emergency Contact Person');
            $table->string('registration_date')->after('relationshipe')->nullable()->comment('Emergency Contact Person');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('emergency_contact_person')->after('pin')->nullable()->comment('Emergency Contact Person');
            $table->string('emergency_contact_number')->after('emergency_contact_person')->nullable()->comment('Emergency Contact Person');
            $table->string('relationshipe')->after('emergency_contact_number')->nullable()->comment('Emergency Contact Person');
            $table->string('registration_date')->after('relationshipe')->nullable()->comment('Emergency Contact Person');
        });
    }
}