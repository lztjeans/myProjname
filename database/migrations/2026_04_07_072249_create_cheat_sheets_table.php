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
        Schema::create('cheatSheets', function (Blueprint $table) {
            $table->id();
            $table->string('category');
            $table->string('commandName');
            $table->string('description');
            $table->string('creater');
            $table->string('updater');            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cheatSheets');
    }
};
