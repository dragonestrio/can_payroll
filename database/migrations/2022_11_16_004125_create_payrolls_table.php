<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePayrollsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('payrolls', function (Blueprint $table) {
            $table->id()->autoIncrement();
            $table->string('user_id');
            $table->string('employee_id');
            $table->date('date');
            $table->text('description')->nullable();
            $table->softDeletes();
            $table->timestamps();

            $table->foreign('user_id')
            ->references('id')->on('users')->onDelete('cascade');
            // $table->foreign('employee_id')
            // ->references('id')->on('employees')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('payrolls');
    }
}
