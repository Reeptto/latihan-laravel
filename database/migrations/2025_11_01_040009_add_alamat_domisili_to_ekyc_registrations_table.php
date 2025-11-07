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
        Schema::table('ekyc_registrations', function (Blueprint $table) {
                $table->string('domisili')->nullable()->after('file_ijazah');
                $table->string('provinsi', 100)->nullable()->after('alamat');
                $table->string('kota', 100)->nullable()->after('provinsi');
                $table->string('kecamatan')->nullable()->after('kota');
                $table->string('kode_pos')->nullable()->after('kecamatan');
                $table->string('nama_ibu')->nullable()->after('kode_pos');
                $table->string('sumber')->nullable()->after('nama_ibu');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('ekyc_registrations', function (Blueprint $table) {
            $table->dropColumn([
                'domisili',
                'provinsi',
                'kota',
                'kecamatan',
                'kode_pos',
                'nama_ibu',
                'sumber',
            ]);
        });
    }
};
