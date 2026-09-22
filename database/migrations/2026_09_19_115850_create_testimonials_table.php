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
    Schema::create('testimonials', function (Blueprint $table) {
        $table->id();
        $table->string('name');
        $table->string('role')->nullable(); // misal: Mahasiswa Teknik Informatika
        $table->string('photo')->nullable();
        $table->text('message');
        $table->unsignedTinyInteger('rating')->default(5);
        $table->boolean('is_active')->default(true);
        $table->integer('order')->default(0);
        $table->timestamps();
    });
}
    public function down(): void
    {
        Schema::dropIfExists('testimonials');
    }
};
