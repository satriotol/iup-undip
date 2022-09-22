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
        Schema::create('international_mahasiswas', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_mahasiswa_id');
            $table->unsignedBigInteger('international_status_id');
            $table->unsignedBigInteger('international_category_id');
            $table->unsignedBigInteger('international_university_id');
            $table->unsignedBigInteger('international_program_id');
            $table->unsignedBigInteger('international_funding_id');
            $table->string('duration');
            $table->year('year');
            $table->date('start_at');
            $table->date('end_at');
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
        Schema::dropIfExists('international_mahasiswas');
    }
};
