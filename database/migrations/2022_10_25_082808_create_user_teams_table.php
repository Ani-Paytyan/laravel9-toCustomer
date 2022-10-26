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
        Schema::create('team_contacts', function (Blueprint $table) {
            $table->uuid()->primary();
            $table->uuid('contact_id');
            $table->uuid('team_id');
            $table->string('role');
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('contact_id')->references('uuid')->on('contacts');
            $table->foreign('team_id')->references('uuid')->on('teams');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('team_contacts');
    }
};
