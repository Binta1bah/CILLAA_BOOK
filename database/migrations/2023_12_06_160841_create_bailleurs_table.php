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
        Schema::create('bailleurs', function (Blueprint $table) {
            $table->id();
            $table->string('nom');
            $table->string('image');
            $table->text('description');
            $table->string('telephone');
            $table->enum('organisme' ,['ONG', 'Entreprise', 'Particulier']);
            $table->string('email');
            $table->string('motdepasse');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bailleurs');
    }
};
