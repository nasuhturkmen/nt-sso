<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAdminTables extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function getConnection()
    {
        return config('sso.database.connection') ?: config('database.default');
    }

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create(config('sso.database.users_table'), function (Blueprint $table) {
            $table->string('ntauth_id', 36)->unique();
            $table->text('ntauth_access_token');
            $table->text('ntauth_refresh_token')->nullable();
            $table->string('password', 512)->nullable();
            $table->timestamps();
        });


        Schema::create(config('sso.database.operation_log_table'), function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id');
            $table->string('path');
            $table->string('method', 10);
            $table->string('ip');
            $table->text('input');
            $table->index('user_id');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists(config('sso.database.users_table'));
        Schema::dropIfExists(config('sso.database.operation_log_table'));
    }
}
