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
        Schema::create('attendances', function (Blueprint $table) {
            // Primary key
            $table->id();

            // FK to employees.id (unsignedBigInteger matches the default id type)
            $table->unsignedBigInteger('employee_id');
            $table->foreign('employee_id')
                  ->references('id')
                  ->on('employees')
                  ->onDelete('cascade');

            // Attendance date (non-nullable by default)
            $table->date('attendance_date');

            // Present/absent flag (boolean defaults to false)
            $table->boolean('state')->default(false);

            // Time of attendance, defaulting to the current DB time
            $table->time('attendance_time')
                  ->default(DB::raw('CURRENT_TIME'));

            // In/Out marker as boolean (0/1)
            $table->boolean('type')->default(false);

            // Status code (tiny integer, non-nullable)
            $table->unsignedTinyInteger('status');

            // Laravel’s created_at / updated_at
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('attendances');
    }
};
