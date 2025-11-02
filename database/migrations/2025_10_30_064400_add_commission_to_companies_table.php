<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('companies', function (Blueprint $table) {
            if (!Schema::hasColumn('companies', 'commission')) {
                $table->decimal('commission', 5, 2)->default(0); // 0–100
            } else {
                $table->decimal('commission', 5, 2)->default(0)->change();
            }

            if (!Schema::hasColumn('companies', 'approved')) {
                $table->boolean('approved')->default(false);
            }
        });
    }

    public function down(): void
    {
        Schema::table('companies', function (Blueprint $table) {
            // opcional revertir
        });
    }
};
