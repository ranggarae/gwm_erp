<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('fleets', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('license_plate')->unique();
            $table->integer('year');
            $table->string('engine_capacity');
            $table->string('photo')->nullable();
            $table->date('stnk_expiry_date');
            $table->date('kir_expiry_date')->nullable();
            $table->date('insurance_expiry_date')->nullable();
            $table->enum('status', ['Available', 'In Use', 'Maintenance'])->default('Available');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('fleets');
    }
};
