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
        Schema::create('landing_settings', function (Blueprint $table) {
            $table->id();
            $table->string('key')->unique()->comment('unique key, contoh: hero_title, site_title');
            $table->longText('value')->nullable()->comment('text,image,url,json');
<<<<<<< HEAD
=======
            $table->string('type')->default('text')->comment('text,image,url,json');
>>>>>>> 3287f6d30efb566eb689d3b1a46e6fa37eab0505
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('landing_settings');
    }
};
