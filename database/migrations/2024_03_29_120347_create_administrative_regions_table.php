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
        Schema::create('administrative_regions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('admin_id')->constrained('users')->nullable()->onUpdate('cascade')->onDelete('cascade');
            $table->string('name');
            $table->string('photo');
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('administrative_regions');
    }
};
