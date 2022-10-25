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
        Schema::create('unique_items', function (Blueprint $table) {
            $table->uuid()->primary();
            $table->uuid('item_id');
            $table->uuid('workplace_id');
            $table->string('name', 255)->nullable();
            $table->string('article', 255)->nullable();
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('item_id')->references('uuid')->on('items');
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
        Schema::dropIfExists('unique_items');
    }
};
