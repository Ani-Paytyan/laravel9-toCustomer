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
        Schema::table('workplaces', function (Blueprint $table) {
            $table->string('sum_price')->nullable()->after('address');
            $table->string('status')->nullable()->after('address');
            $table->string('city')->nullable()->after('address');
            $table->string('number')->nullable()->after('address');
            $table->string('zip')->nullable()->after('address');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('workplaces', function (Blueprint $table) {
            $table->dropColumn(['sum_price', 'status', 'city', 'number', 'zip']);
        });
    }
};
