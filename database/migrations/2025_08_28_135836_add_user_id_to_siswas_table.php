<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddUserIdToSiswasTable extends Migration
{
    public function up()
    {
        Schema::table('siswas', function (Blueprint $table) {
            $table->foreignId('user_id')
                ->nullable()
                ->after('kelas_id') // Posisi setelah kelas_id
                ->constrained() // Secara default ke tabel "users"
                ->onDelete('set null'); // Jika user dihapus, user_id jadi null
        });
    }

    public function down()
    {
        Schema::table('siswas', function (Blueprint $table) {
            $table->dropForeign(['user_id']);
            $table->dropColumn('user_id');
        });
    }
}

