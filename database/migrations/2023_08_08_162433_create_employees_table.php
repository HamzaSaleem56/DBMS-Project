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
        Schema::create('employees', function (Blueprint $table) {
            // Primary key
            $table->id();

            // Foreign keys (must match the referenced PK types)
            $table->unsignedBigInteger('department_id');
            $table->foreign('department_id')
                  ->references('id')
                  ->on('departments')
                  ->onDelete('cascade');

            $table->unsignedBigInteger('designation_id');
            $table->foreign('designation_id')
                  ->references('id')
                  ->on('designations')
                  ->onDelete('cascade');

            $table->unsignedBigInteger('schedule_id');
            $table->foreign('schedule_id')
                  ->references('id')
                  ->on('schedules')
                  ->onDelete('cascade');

            // Basic personal info
            $table->string('firstname', 50);
            $table->string('lastname', 50);

            // Unique employee code/ID
            $table->string('unique_id', 25)->unique();

            // Contact
            $table->string('email', 100)->unique();
            $table->string('phone', 19)->unique();

            // Address (can be longer than 255 if you like)
            $table->string('address', 255);

            // Date of birth
            $table->date('dob');

            // Gender – if you only allow a few values, consider ENUM here:
            // $table->enum('gender', ['male','female','other']);
            $table->string('gender', 10);
            $table->string('religion', 15);
            
            // Marital status – likewise, ENUM may be better:
            // $table->enum('marital', ['single','married','divorced','widowed']);
            $table->string('marital', 15);
            $table->tinyInteger('status')->default(0);
            // Timestamps
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('employees');
    }
};
