<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('additional_working_days', function (Blueprint $table) {
            $table->uuid()->primary();
            $table->date('date');
            $table->time('from');
            $table->time('to');
            $table->uuid('workplace_id')->nullable();
            $table->timestamps();

            $table->foreign('workplace_id')->references('uuid')->on('workplaces');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('additional_working_days');
    }
};
