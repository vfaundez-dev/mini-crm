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
        Schema::create('contacts', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->boolean('is_active')->default(1);
            $table->string('first_name', 150);
            $table->string('last_name', 150)->nullable();
            $table->string('full_name', 200);
            $table->string('gender', 50);
            $table->string('email', 50);
            $table->string('phone', 50)->nullable();
            $table->string('address')->nullable();
            $table->string('country', 150);
            $table->string('state', 150)->nullable();
            $table->string('city', 150)->nullable();
            // Foreign Key Constraint
            $table->foreignId('client_id')->constrained('clients')->onDelete('cascade');
            $table->foreignId('department_id')->nullable()->constrained('contact_departments')->onUpdate('cascade')->onDelete('restrict');
            $table->foreignId('job_title_id')->nullable()->constrained('contact_job_titles')->onUpdate('cascade')->onDelete('restrict');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('contacts');
    }
};
