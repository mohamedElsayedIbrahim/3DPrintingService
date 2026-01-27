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
    Schema::create('orders', function (Blueprint $table) {
        $table->id();

        $table->string('full_name');
        $table->string('email');
        $table->string('phone');
        $table->string('city')->nullable();

        $table->text('project_description');

        $table->string('material');
        $table->integer('quantity')->default(1);

        $table->date('delivery_date')->nullable();

        $table->text('notes')->nullable();

        $table->string('status')->default('قيد المراجعة');

        $table->decimal('total_cost', 8, 2)->nullable();

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
