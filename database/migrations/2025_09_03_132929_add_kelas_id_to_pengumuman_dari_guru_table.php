<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddKelasIdToPengumumanDariGuruTable extends Migration
{
    public function up()
    {
        Schema::table('pengumuman_dari_gurus', function (Blueprint $table) {
            $table->unsignedBigInteger('kelas_id')->after('announce_date');

            // Jika ada relasi foreign key:
            $table->foreign('kelas_id')->references('id')->on('kelas')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::table('pengumuman_dari_gurus', function (Blueprint $table) {
            // Drop foreign key dulu (kalau ditambahkan)
            $table->dropForeign(['kelas_id']);
            $table->dropColumn('kelas_id');
        });
    }
}

