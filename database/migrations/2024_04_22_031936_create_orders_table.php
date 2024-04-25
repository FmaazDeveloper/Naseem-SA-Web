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
            $table->foreignId('tourist_id')->constrained('users')->onUpdate('cascade')->onDelete('cascade');
            $table->foreignId('guide_id')->constrained('users')->onUpdate('cascade')->onDelete('cascade');
            $table->foreignId('admin_id')->nullable()->constrained('users')->onUpdate('cascade')->onDelete('cascade');
            $table->foreignId('region_id')->constrained('regions')->onUpdate('cascade')->onDelete('cascade');
            $table->foreignId('status_id')->constrained('status_types')->onUpdate('cascade')->onDelete('cascade');
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
