<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->string('id')->primary();
            $table->string('email', 100)->unique();
            $table->string('password', 100);
            $table->string('name');
            $table->string('phone', 14);
            $table->enum('gender', ['male', 'female', 'hidden']);
            $table->text('address')->nullable();
            $table->date('date_born');
            $table->string('profile_pic')->nullable();
            $table->timestamp('email_verified_at')->nullable();
            $table->rememberToken();
            $table->softDeletes();
            $table->timestamps();
            // $table->unsignedBigInteger('role_id');

            // $table->foreign('role_id')
            //     ->references('id')->on('roles')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
