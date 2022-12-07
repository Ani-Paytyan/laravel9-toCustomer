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
        Schema::table('unique_items', function (Blueprint $table) {
            $table->string('mac')->after('article');
            $table->boolean('is_inside')->default(false)->after('is_online');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('unique_items', function (Blueprint $table) {
            $table->dropColumn('mac');
            $table->dropColumn('is_online');
        });
    }
};
