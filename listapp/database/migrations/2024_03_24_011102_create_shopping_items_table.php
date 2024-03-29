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
        Schema::create('shopping_items', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->boolean('purchased')->default(false);
            $table->timestamps();
            $table->string('share_code', 4)->unique()->nullable();
            $table->boolean('is_shared')->default(false);
            $table->string('owner'); // Assuming you have this column
            $table->foreign('owner')->references('email')->on('users');
            $table->unsignedBigInteger('list_id')->nullable();
        });
    }



    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('shopping_items');
    }
};
