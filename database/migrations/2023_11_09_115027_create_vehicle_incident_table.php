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
        Schema::create('vehicle_incident', function (Blueprint $table) {
            $table->id();
            $table->unsignedBiginteger('vehicle_id')->unsigned();
            $table->unsignedBiginteger('incident_id')->unsigned();

            $table->foreign('vehicle_id')->references('id')
                    ->on('vehicles')->onDelete('cascade');
            $table->foreign('incident_id')->references('id')
                    ->on('incidents')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('vehicle_incident');
    }
};
