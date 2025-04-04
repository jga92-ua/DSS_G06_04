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
        Schema::table('cartas', function (Blueprint $table) {
            $table->string('nombre_carta_api')->after('id_carta_api')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('cartas', function (Blueprint $table) {
            $table->dropColumn('nombre_carta_api');
        });
    }
};
