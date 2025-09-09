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
        Schema::table('materis', function (Blueprint $table) {
            $table->unsignedBigInteger('siswa_id')->after('id')->nullable();

            // Jika ingin langsung relasi foreign key:
             $table->foreign('siswa_id')->references('id')->on('siswas')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::table('materi', function (Blueprint $table) {
            // Hapus foreign key jika ada
            // $table->dropForeign(['siswa_id']);

            $table->dropColumn('siswa_id');
        });
    }

};
