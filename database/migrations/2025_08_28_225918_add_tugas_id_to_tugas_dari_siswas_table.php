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
            $table->unsignedBigInteger('tugas_id')->after('siswa_id');

            // Jika ingin buat relasi foreign key juga:
            $table->foreign('tugas_id')->references('id')->on('tugas_dari_gurus')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::table('tugas_dari_siswas', function (Blueprint $table) {
            $table->dropForeign(['tugas_id']);
            $table->dropColumn('tugas_id');
        });
    }

};
