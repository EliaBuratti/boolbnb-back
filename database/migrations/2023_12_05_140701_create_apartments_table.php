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
        Schema::create('apartments', function (Blueprint $table) {
            $table->id();
            $table->string('title', 100);
            $table->string('slug');
            $table->bigInteger('apartment_code');
            $table->string('nation', 80);
            /* $table->string('city', 30);
            $table->string('postal_code', 10); */
            $table->string('address', 100);
            $table->float('latitude', 9, 7);
            $table->float('longitude', 10, 7);
            $table->tinyInteger('rooms', false, true);
            $table->tinyInteger('bathrooms', false, true);
            $table->tinyInteger('beds', false, true);
            $table->smallInteger('m_square', false, true);
            $table->text('description');
            $table->string('thumbnail', 255);
            $table->boolean('visible')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('apartments');
    }
};
