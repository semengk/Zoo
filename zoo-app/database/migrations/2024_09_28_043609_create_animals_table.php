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
        Schema::create('animals', function (Blueprint $table) {
            $table->id();

            $table->string('name');
            $table->string('species');
            $table->integer('age');
            $table->text('description')->nullable();

            $table->unsignedBigInteger('cage_id');
            $table->index('cage_id', 'animal_cage_idx');
            $table->foreign('cage_id', 'animal_cage_fk')->on('cage')->references('id');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('animals');
    }
};
