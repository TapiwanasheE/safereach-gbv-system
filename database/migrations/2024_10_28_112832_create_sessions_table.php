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
        Schema::create('sessions', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('case_id');
            $table->unsignedBigInteger('counselor_id');
            $table->dateTime('scheduled_time');
            $table->time('duration')->nullable();
            $table->string('session_link')->nullable();
            $table->enum('status', ['scheduled', 'completed', 'canceled'])->default('scheduled');
            $table->timestamps();

            $table->foreign('case_id')->references('id')->on('gbv_cases')->onDelete('cascade');
            $table->foreign('counselor_id')->references('id')->on('users')->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sessions');
    }
};
