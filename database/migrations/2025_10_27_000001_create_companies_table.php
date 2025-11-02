<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('companies', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id'); // dueño de la empresa
            $table->string('name');
            $table->string('nit')->nullable();
            $table->string('address')->nullable();
            $table->boolean('approved')->default(false); // aprobado por admin
            $table->decimal('commission',5,2)->default(0); // % comisión
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }
    public function down(): void
    {
        Schema::dropIfExists('companies');
    }
};
