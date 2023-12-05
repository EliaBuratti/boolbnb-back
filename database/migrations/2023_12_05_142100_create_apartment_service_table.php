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
        Schema::create('apartment_service', function (Blueprint $table) {
            $table->unsignedBigInteger('apartment_id');
            $table->foreign('apartment_id')
                ->references('id')
                ->on('apartments');

            $table->unsignedBigInteger('service_id');
            $table->foreign('service_id')
                ->references('id')
                ->on('services');

            # Per indicare che entrambi i campi sono chiavi primarie
            $table->primary(['apartment_id', 'service_id']);

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('apartment_service');
    }
};
