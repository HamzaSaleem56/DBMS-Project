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
        Schema::create('users', function (Blueprint $table) {
            // Primary key
            $table->id();

            // Role (foreign key with default role_id = 8)
            $table->unsignedBigInteger('role_id')->default(8);
            $table->foreign('role_id')
                  ->references('id')
                  ->on('roles')
                  ->onDelete('cascade');

            // Basic info
            $table->string('name', 100);
            $table->string('email', 100)->unique();
            $table->string('phone', 20)->unique();

            // Account status (0 = inactive by default)
            $table->unsignedTinyInteger('status')->default(0);

            // Email verification
            $table->timestamp('email_verified_at')->nullable();

            // Auth fields
            $table->string('password');
            $table->rememberToken();

            // created_at & updated_at
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
