<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePayrollDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('payroll_details', function (Blueprint $table) {
            $table->id()->autoIncrement();
            // $table->bigInteger('payroll_category_id')->nullable();
            // $table->bigInteger('payroll_id');
            $table->string('name')->nullable();
            $table->enum('type', ['static', 'dynamic']);
            $table->bigInteger('value');
            $table->text('description')->nullable();
            $table->softDeletes();
            $table->timestamps();

            $table->foreignId('payroll_category_id')->nullable()
                ->references('id')->on('payroll_categories')->onDelete('cascade');
            $table->foreignId('payroll_id')
                ->references('id')->on('payrolls')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('payroll_details');
    }
}
