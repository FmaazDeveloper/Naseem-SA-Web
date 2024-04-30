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
        Schema::create('profiles', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->unique()->constrained('users')->onUpdate('cascade')->onDelete('cascade');
            $table->string('photo')->nullable();
            $table->string('phone_number')->unique()->nullable();
            $table->integer('age')->nullable();
            $table->enum('gender', ['Male', 'Female'])->nullable();
            $table->string('nationality')->nullable();
            $table->String('language')->nullable();
            $table->foreignId('region_id')->nullable()->constrained('regions')->onUpdate('cascade')->onDelete('cascade');
            $table->String('certificate')->nullable();
            $table->String('overview')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('profiles');
    }
};
