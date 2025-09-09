<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;


return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('tugas_dari_siswas', function (Blueprint $table) {
            $table->integer('nilai')->nullable()->after('file_url'); // Menambahkan kolom 'nilai' setelah 'file_url'
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('migrasi_tugas_dari_siswas', function (Blueprint $table) {
            $table->dropColumn('nilai');
        });
    }
};
