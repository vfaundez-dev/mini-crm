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
        Schema::create('opportunities', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->boolean('is_active')->default(1);
            $table->string('name');
            $table->string('status')->default('open');
            $table->decimal('estimated_value', 15, 2)->nullable();
            $table->decimal('weighted_value', 15, 2)->nullable();
            $table->decimal('success_probability')->nullable();
            $table->string('source')->nullable();
            $table->date('created_date')->useCurrent();
            $table->date('estimated_close_date')->nullable();
            $table->date('actual_close_date')->nullable();
            // Foreign Key Constraints
            $table->foreignId('client_id')->nullable()->constrained('clients')->onDelete('set null');
            $table->foreignId('owner_id')->nullable()->constrained('users')->onDelete('set null');
            $table->foreignId('stage_id')->nullable()->constrained('opportunity_stages')->onUpdate('cascade')->onDelete('restrict');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('opportunities');
    }
};
