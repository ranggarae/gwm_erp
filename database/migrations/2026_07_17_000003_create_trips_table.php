<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('trips', function (Blueprint $table) {
            $table->id();
            $table->foreignId('fleet_id')->constrained('fleets');
            $table->foreignId('driver_id')->constrained('drivers');
            $table->text('route_destination');
            $table->text('purpose');
            $table->dateTime('start_date');
            $table->dateTime('end_date')->nullable();
            $table->integer('start_odometer');
            $table->integer('end_odometer')->nullable();
            $table->enum('status', ['Scheduled', 'Ongoing', 'Completed', 'Cancelled'])->default('Scheduled');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('trips');
    }
};
