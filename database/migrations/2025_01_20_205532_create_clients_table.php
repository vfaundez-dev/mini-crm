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
        Schema::create('clients', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->boolean('is_active')->default(1);
            $table->string('name', 150);
            $table->string('email', 100);
	        $table->string('main_phone', 50);
	        $table->string('secondary_phone', 50)->nullable();
            $table->string('address_1', 150);
	        $table->string('address_2', 150)->nullable();
	        $table->string('address_3', 150)->nullable();
	        $table->string('website', 150)->nullable();
            $table->string('country', 150);
            $table->string('state', 150)->nullable();
            $table->string('city', 150)->nullable();
            // Foreign Key Constraint
            $table->foreignId('owner_id')->nullable()->constrained('users')->onDelete('set null');
            $table->foreignId('industry_id')->nullable()->constrained('client_industries')->onUpdate('cascade')->onDelete('restrict');
            $table->foreignId('status_id')->constrained('client_status')->onUpdate('cascade')->onDelete('restrict');
            $table->foreignId('type_id')->constrained('client_types')->onUpdate('cascade')->onDelete('restrict');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('clients');
    }
};
