<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     * This method will create the 'students' table in the database.
     */
    public function up(): void
    {
        Schema::create('students', function (Blueprint $table) {
            // Create an auto-incrementing primary key column called 'id'
            $table->id(); // Primary key, auto-increment
            
            // Create a 'name' column, required (cannot be null)
            $table->string('name')->nullable(false); // Required field for student's name
            
            // Create an 'email' column, required, and it must be unique
            $table->string('email')->unique()->nullable(false); // Required and unique email
            
            // Create a 'phone' column, required (will need additional validation in the controller)
            $table->string('phone')->nullable(false); // Ensure to validate format in your controllers if needed
            
            // Create a 'dob' (date of birth) column, required
            $table->date('dob'); 
            
            // Create a foreign key column 'college_id', referencing the 'id' column of the 'colleges' table
            // If a college is deleted, all related students will also be deleted (cascade delete)
            $table->foreignId('college_id')->constrained('colleges')->onDelete('cascade'); 
            
            // Laravel will automatically add 'created_at' and 'updated_at' timestamp columns
            $table->timestamps(); // created_at and updated_at timestamps
        });
    }

    /**
     * Reverse the migrations.
     * This method will drop the 'students' table from the database if needed (rollback).
     */
    public function down(): void
    {
        Schema::dropIfExists('students'); // Drop the 'students' table
    }
};
