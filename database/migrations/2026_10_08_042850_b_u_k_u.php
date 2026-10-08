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
        Schema::create('BUKU', function (Blueprint $table) {
            $table->id()->autoIncrement();
            $table->foreignId('category_id')->constrained('KATEGORI')->cascadeOnDelete();
            $table->string('title');
            $table->string('author');
            $table->integer('published_year');
            $table->integer('stock');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('BUKU');
    }
};
