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
        Schema::create('work_days', function (Blueprint $table) {
            $table->uuid()->primary();
            $table->uuid('company_id')->nullable();
            $table->uuid('workplace_id')->nullable();
            $table->integer('day_of_week');
            $table->time('from');
            $table->time('to');
            $table->boolean('is_active')->default(0);
            $table->timestamps();

            $table->foreign('company_id')->references('uuid')->on('companies');
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
        Schema::dropIfExists('work_days');
    }
};
