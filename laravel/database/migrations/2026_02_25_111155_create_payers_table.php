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
       Schema::create('payers', function (Blueprint $table) {
    $table->id();
    $table->foreignId('sender_id')->constrained('users')->cascadeOnDelete();
    $table->foreignId('reciever_id')->constrained('users')->cascadeOnDelete();
    $table->foreignId('colocation_id')->constrained()->cascadeOnDelete();
    $table->decimal('montant', 10, 2);
    $table->timestamp('paid_at')->nullable();
    $table->timestamps();
});
    }


    public function down(): void
    {
        Schema::dropIfExists('Payers');
    }
};
