<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('tugas_dari_gurus', function (Blueprint $table) {
            // Menambahkan foreign key kelas_id setelah user_id
            $table->foreignId('kelas_id')
                  ->nullable()
                  ->after('user_id')
                  ->constrained()
                  ->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::table('tugas_dari_gurus', function (Blueprint $table) {
            $table->dropForeign(['kelas_id']);
            $table->dropColumn('kelas_id');
        });
    }
};
