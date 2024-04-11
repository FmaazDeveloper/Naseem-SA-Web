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
        Schema::create('regions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('admin_id')->constrained('users')->nullable()->onUpdate('cascade')->onDelete('cascade');
            $table->enum('type', ['City', 'Island']);
            $table->string('name');
            $table->text('main_description');
            $table->string('weather_description');
            $table->string('card_description');
            $table->string('card_photo');
            $table->boolean('is_active')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('regions');
    }
};
