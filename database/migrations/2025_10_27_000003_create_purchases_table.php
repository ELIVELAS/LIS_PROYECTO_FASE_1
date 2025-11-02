<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('purchases', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('offer_id');
            $table->unsignedInteger('qty')->default(1);
            $table->string('card_last4',4);
            $table->date('card_exp');
            $table->string('invoice_code',16)->unique(); // código único de validación
            $table->decimal('unit_price',10,2);
            $table->decimal('total',10,2);
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('offer_id')->references('id')->on('offers')->onDelete('cascade');
        });
    }
    public function down(): void { Schema::dropIfExists('purchases'); }
};
