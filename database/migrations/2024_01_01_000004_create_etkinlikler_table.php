<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (!Schema::hasTable('etkinlikler')) {
            Schema::create('etkinlikler', function (Blueprint $table) {
                $table->id();
                $table->foreignId('user_id')->nullable()->constrained()->nullOnDelete();
                $table->foreignId('city_id')->nullable()->constrained()->nullOnDelete();
                $table->foreignId('district_id')->nullable()->constrained()->nullOnDelete();
                $table->string('title');
                $table->string('slug')->unique();
                $table->text('description')->nullable();
                $table->string('image')->nullable();
                $table->string('location')->nullable();
                $table->string('category')->nullable();
                $table->string('cost')->nullable();
                $table->timestamp('date')->nullable();
                $table->enum('source_type', ['user', 'official'])->default('user');
                $table->enum('status', ['pending', 'approved', 'rejected'])->default('pending');
                $table->timestamps();
            });
        }
    }

    public function down(): void
    {
        Schema::dropIfExists('etkinlikler');
    }
};
