<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('home_abouts', function (Blueprint $table) {
            $table->string('type')->default('sejarah')->after('title');
            // type: 'sejarah' = Sejarah Perusahaan (left column)
            //       'visi-misi' = Visi & Misi (right column)
        });
    }

    public function down(): void
    {
        Schema::table('home_abouts', function (Blueprint $table) {
            $table->dropColumn('type');
        });
    }
};
