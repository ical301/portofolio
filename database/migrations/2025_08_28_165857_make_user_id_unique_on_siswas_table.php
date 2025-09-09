<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class MakeUserIdUniqueOnSiswasTable extends Migration
{
    public function up()
    {
        Schema::table('siswas', function (Blueprint $table) {
            $table->unique('user_id'); // Tambah unique constraint
        });
    }

    public function down()
    {
        Schema::table('siswas', function (Blueprint $table) {
            $table->dropUnique(['user_id']); // Hapus unique constraint
        });
    }
}

