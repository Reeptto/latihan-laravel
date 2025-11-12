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
        // Ubah enum dengan raw SQL (karena laravel tidak bisa ubah enum langsung via blueprint)
        Schema::table('ekyc_registration', function (Blueprint $table) {
            DB::statement("ALTER TABLE ekyc_registrations MODIFY COLUMN status ENUM('draft', 'submitted', 'accepted', 'rejected') DEFAULT 'draft'");
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('ekyc_registration', function (Blueprint $table) {
            // Rollback ke enum semula
            DB::statement("ALTER TABLE ekyc_registration MODIFY COLUMN status ENUM('draft', 'submitted') DEFAULT 'draft'");
        });
    }
};
