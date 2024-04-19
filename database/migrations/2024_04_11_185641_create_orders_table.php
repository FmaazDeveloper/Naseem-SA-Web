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
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->integer('tourist_id');
            $table->integer('guide_id');
            $table->integer('admin_id');
            $table->integer('region_id');
            $table->integer('number_of_people');
            $table->integer('number_of_days');
            $table->enum('status', ['Active', 'Pending', 'Completed', 'Canceled']);
            $table->timestamp('closed_at')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
