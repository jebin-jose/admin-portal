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
        Schema::create('custom_fields', function (Blueprint $table) {
            $table->id();
            $table->enum('module', ['customer', 'invoice']);
            $table->string('name');
            $table->enum('type', ['text', 'date', 'decimal', 'dropdown', 'lookup']);
            $table->json('options')->nullable(); // For dropdown options or lookup configurations
            $table->boolean('is_required')->default(false);
            $table->string('lookup_module')->nullable(); // For lookup type
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('custom_fields');
    }
};
