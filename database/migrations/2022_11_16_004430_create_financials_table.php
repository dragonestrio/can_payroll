<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFinancialsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('financials', function (Blueprint $table) {
            $table->id()->autoIncrement();
            $table->string('user_id');
            $table->string('name')->nullable();
            $table->enum('category', ['additional', 'deductions']);
            $table->bigInteger('value');
            $table->text('description')->nullable();
            $table->softDeletes();
            $table->timestamps();

            $table->foreign('user_id')
            ->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('financials');
    }
}
