<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
   public function up(): void
{
    Schema::create('service_packages', function (Blueprint $table) {
        $table->id();
        $table->foreignId('service_id')->constrained()->cascadeOnDelete();
        $table->string('name'); // Basic, Standard, Premium
        $table->decimal('price', 12, 2);
        $table->integer('delivery_days')->nullable();
        $table->json('features')->nullable(); // list fitur per paket
        $table->boolean('is_popular')->default(false);
        $table->integer('order')->default(0);
        $table->timestamps();
    });
}
};
