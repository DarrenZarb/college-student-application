<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     * This will create the 'colleges' table with appropriate fields
     */
    public function up(): void
    {
        Schema::create('colleges', function (Blueprint $table) {
            $table->id(); //Primary key with auto-increment
            $table->string('name')->unique(); //required and must be unique
            $table->string('address')->nullable(false); //College address, required
            $table->timestamps(); // created_at and updated_at timestamps
        });
    }

    /**
     * Reverse the migrations.
     * This will drop the 'colleges' table if it exists
     */
    public function down(): void
    {
        Schema::dropIfExists('colleges');
    }
};
