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
        Schema::create('cultural_heritages', function (Blueprint $table) {
            $table->id();
            $table->string('indigenous_nationalities')->nullable();
            $table->string('event_name')->nullable();
            $table->string('cultural_property')->nullable();
            $table->string('event_time')->nullable();
            $table->unsignedBigInteger('district_id');
            $table->string('conservator')->nullable();


            $table->foreign('district_id')->references('id')->on('districts')->onDelete('cascade');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cultural_heritages');
    }
};
