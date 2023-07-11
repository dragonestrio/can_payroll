<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePayrollCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('payroll_categories', function (Blueprint $table) {
            $table->id()->autoIncrement();
            $table->string('name');
            $table->enum('type', ['static', 'dynamic']);
            $table->bigInteger('value_default')->nullable();
            $table->string('description')->nullable();
            $table->softDeletes();
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
        Schema::dropIfExists('payroll_categories');
    }
}
