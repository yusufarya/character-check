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
        Schema::create('character_frequency', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('character_check_id');
            $table->string('notes', 250)->nullable();
            $table->timestamps();

            $table->foreign('character_check_id')->on('character_check')->references('id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('character_frequency');
    }
};
