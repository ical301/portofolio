<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddJurusanAndRuangToKelasTable extends Migration
{
    public function up()
    {
        Schema::table('kelas', function (Blueprint $table) {
            $table->string('jurusan')->after('nama_kelas')->nullable();
            $table->string('ruang')->after('jurusan')->nullable();
        });
    }

    public function down()
    {
        Schema::table('kelas', function (Blueprint $table) {
            $table->dropColumn(['jurusan', 'ruang']);
        });
    }
}
