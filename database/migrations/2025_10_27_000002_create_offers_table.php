<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('offers', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('company_id');      // empresa dueña de la oferta
            $table->string('title');
            $table->decimal('price_regular', 10, 2);
            $table->decimal('price_offer', 10, 2);
            $table->date('start_date');
            $table->date('end_date');
            $table->date('redeem_deadline');
            $table->unsignedInteger('stock')->nullable();  // opcional: si null, sin límite
            $table->text('description')->nullable();
            $table->boolean('status')->default(true);      // disponible / no disponible
            $table->timestamps();

            $table->foreign('company_id')->references('id')->on('companies')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('offers');
    }
};
