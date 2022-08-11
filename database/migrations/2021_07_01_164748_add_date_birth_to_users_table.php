<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddDateBirthToUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->date('date_birth')->nullable();
            $table->string('address',500)->nullable();
            $table->text('bio')->nullable();
            $table->string('photo',300)->nullable();
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
            $table->dropForeign(['date_birth'],['address'],['bio'],['photo']);
            $table->dropColumn('date_birth','address','bio','photo');
        });
    }
}
