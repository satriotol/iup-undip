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
        Schema::create('notes', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_mahasiswa_id');
            $table->date('test_date')->nullable();
            $table->string('listening')->nullable();
            $table->string('reading')->nullable();
            $table->string('writing')->nullable();
            $table->string('speaking')->nullable();
            $table->string('overall_score')->nullable();
            $table->string('event_1')->nullable();
            $table->string('event_2')->nullable();
            $table->longText('achievement')->nullable();
            $table->longText('other_information')->nullable();
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
        Schema::dropIfExists('notes');
    }
};
