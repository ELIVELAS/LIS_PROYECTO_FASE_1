<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('companies', function (Blueprint $table) {
            if (!Schema::hasColumn('companies','user_id'))    { $table->unsignedBigInteger('user_id')->after('id'); }
            if (!Schema::hasColumn('companies','name'))       { $table->string('name')->after('user_id'); }
            if (!Schema::hasColumn('companies','nit'))        { $table->string('nit', 20)->after('name'); }
            if (!Schema::hasColumn('companies','address'))    { $table->string('address')->nullable()->after('nit'); }
            if (!Schema::hasColumn('companies','phone'))      { $table->string('phone',25)->nullable()->after('address'); }
            if (!Schema::hasColumn('companies','approved'))   { $table->boolean('approved')->default(false)->after('phone'); }
            if (!Schema::hasColumn('companies','commission')) { $table->decimal('commission',5,2)->nullable()->after('approved'); }
        });

        // --- LIMPIEZA: si quedó una FK/Índice con el nombre viejo, la quitamos sin romper la migración
        try { DB::statement('ALTER TABLE `companies` DROP FOREIGN KEY `companies_user_id_foreign`'); } catch (\Throwable $e) {}
        try { DB::statement('ALTER TABLE `companies` DROP INDEX `companies_user_id_foreign`'); }        catch (\Throwable $e) {}

        // --- Ahora creamos la FK con un nombre NUEVO para evitar choque de nombres
        try {
            DB::statement(
                'ALTER TABLE `companies`
                 ADD CONSTRAINT `fk_companies_userid`
                 FOREIGN KEY (`user_id`) REFERENCES `users`(`id`) ON DELETE CASCADE'
            );
        } catch (\Throwable $e) {
            // si ya existe, lo ignoramos
        }
    }

    public function down(): void
    {
        // quitamos la FK con el nombre nuevo si existe
        try { DB::statement('ALTER TABLE `companies` DROP FOREIGN KEY `fk_companies_userid`'); } catch (\Throwable $e) {}

        Schema::table('companies', function (Blueprint $table) {
            foreach (['commission','approved','phone','address','nit','name','user_id'] as $col) {
                if (Schema::hasColumn('companies',$col)) { $table->dropColumn($col); }
            }
        });
    }
};
