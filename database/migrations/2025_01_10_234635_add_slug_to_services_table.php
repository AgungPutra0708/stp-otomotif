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
        Schema::table('services', function (Blueprint $table) {
            $table->string('slug')->unique()->after('name'); // Menambahkan kolom 'slug'
            $table->string('car_id'); // Menambahkan kolom car_id
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('services', function (Blueprint $table) {
            $table->dropColumn('slug'); // Menghapus kolom 'slug' saat rollback
            $table->dropColumn('car_id'); // Menghapus kolom 'car_id' saat rollback
        });
    }
};
