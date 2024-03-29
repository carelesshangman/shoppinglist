<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::table('shopping_items', function (Blueprint $table) {
            // Reposition column (if desired)
            $table->unsignedBigInteger('list_id')->nullable()->change();
            $table->foreign('list_id')->references('id')->on('shopping_items');
        });
    }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('shopping_items', function (Blueprint $table) {
            //
        });
    }
};
