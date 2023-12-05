<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('views', function (Blueprint $table) {
            $table->unsignedBigInteger('apartament_id')->after('id');
            $table->foreign('apartament_id')->references('id')->on('apartaments');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('views', function (Blueprint $table) {
            $table->dropForeign('views_apartament_id_foreign');
            $table->dropColumn('apartament_id');
        });
    }
};
