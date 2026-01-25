<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('print_settings', function (Blueprint $table) {
    $table->id();
    $table->unsignedBigInteger('order_id');
    $table->unsignedBigInteger('material_id');
    $table->string('color');
    $table->enum('quality', ['Low', 'Medium', 'High']);
    $table->integer('quantity');
    $table->timestamps();

    $table->foreign('order_id')->references('id')->on('orders')->onDelete('cascade');
    $table->foreign('material_id')->references('id')->on('materials')->onDelete('cascade');
});

    }

    public function down(): void
    {
        Schema::dropIfExists('print_settings');
    }
};
