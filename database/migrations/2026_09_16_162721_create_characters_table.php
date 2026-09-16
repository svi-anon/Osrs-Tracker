<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('characters', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->string('name');
            $table->integer('attack')->default(1);
            $table->integer('strength')->default(1);
            $table->integer('defence')->default(1);
            $table->integer('hitpoints')->default(10);
            $table->integer('prayer')->default(1);
            $table->integer('magic')->default(1);
            $table->integer('ranged')->default(1);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('characters');
    }
};