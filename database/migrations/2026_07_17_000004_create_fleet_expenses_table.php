<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('fleet_expenses', function (Blueprint $table) {
            $table->id();
            $table->foreignId('fleet_id')->constrained('fleets');
            $table->foreignId('trip_id')->nullable()->constrained('trips');
            $table->enum('expense_type', ['Fuel', 'Maintenance', 'Toll', 'Parking', 'Others']);
            $table->decimal('amount', 15, 2);
            $table->text('description');
            $table->string('attachment')->nullable();
            $table->enum('status', ['Pending', 'Approved', 'Rejected', 'Posted'])->default('Pending');
            $table->unsignedBigInteger('expense_id')->nullable(); // existing core table
            $table->unsignedBigInteger('approved_by')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('fleet_expenses');
    }
};
