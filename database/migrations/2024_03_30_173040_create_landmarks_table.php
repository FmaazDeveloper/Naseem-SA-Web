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
        Schema::create('landmarks', function (Blueprint $table) {
            $table->id();
            $table->foreignId('administrative_region_id')->constrained('administrative_regions')->onUpdate('cascade')->onDelete('cascade');
            $table->foreignId('region_id')->constrained('regions')->onUpdate('cascade')->onDelete('cascade');
            $table->string('name');
            $table->text('description');
            $table->string('photo');
            $table->string('location');
            $table->boolean('is_active')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('landmarks');
    }
};
