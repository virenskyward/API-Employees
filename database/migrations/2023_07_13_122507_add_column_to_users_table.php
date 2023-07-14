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
            $table->string('address')->after('pin')->nullable()->comment('Address');
            $table->string('city_or_town')->after('address')->nullable()->comment('City Or Town');
            $table->string('state_and_zip_code')->after('city_or_town')->nullable()->comment('State and zip code');
            $table->string('emergency_contact_person')->after('state_and_zip_code')->nullable()->comment('Emergency Contact Person');
            $table->string('emergency_contact_number')->after('emergency_contact_person')->nullable()->comment('Emergency Contact number');
            $table->string('relationshipe')->after('emergency_contact_number')->nullable()->comment('Relationshipe');
            $table->string('registration_date')->after('relationshipe')->nullable()->comment('Registration Date');
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
           $table->string('address')->after('pin')->nullable()->comment('Address');
            $table->string('city_or_town')->after('address')->nullable()->comment('City Or Town');
            $table->string('state_and_zip_code')->after('city_or_town')->nullable()->comment('State and zip code');
            $table->string('emergency_contact_person')->after('state_and_zip_code')->nullable()->comment('Emergency Contact Person');
            $table->string('emergency_contact_number')->after('emergency_contact_person')->nullable()->comment('Emergency Contact number');
            $table->string('relationshipe')->after('emergency_contact_number')->nullable()->comment('Relationshipe');
            $table->string('registration_date')->after('relationshipe')->nullable()->comment('Registration Date');
        });
    }
}