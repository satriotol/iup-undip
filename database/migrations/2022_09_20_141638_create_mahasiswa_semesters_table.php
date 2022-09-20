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
        Schema::create('mahasiswa_semesters', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_mahasiswa_id');
            $table->unsignedBigInteger('semester_id');
            $table->unsignedBigInteger('semester_status_id');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('mahasiswa_semesters');
    }
};
