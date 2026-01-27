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
        Schema::create('orders', function (Blueprint $table) {
    $table->id();
    $table->string('full_name');
    $table->string('email');
    $table->string('phone');
    $table->string('city')->nullable();
    $table->text('description');
    $table->string('material');
    $table->integer('quantity');
    $table->date('delivery_at')->nullable();
    $table->text('notes')->nullable();
    $table->string('file_path');
    $table->string('status')->default('pending');
    $table->decimal('cost', 10, 2)->default(0);
    $table->timestamps();
});

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
