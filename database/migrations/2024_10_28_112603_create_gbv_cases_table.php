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
        Schema::create('gbv_cases', function (Blueprint $table) {

            $table->id();
            $table->unsignedBigInteger('user_id')->nullable(); // Victim ID, NULL for anonymous
            $table->unsignedBigInteger('assigned_staff_id')->nullable();
            $table->string('status')->default('reported');
            $table->string('type'); // Type of case, e.g., domestic abuse, harassment
            $table->text('description');
            $table->date('date_reported');
            $table->string('location')->nullable();
            $table->string('stage')->default('open');
            $table->timestamps();

        $table->foreign('user_id')->references('id')->on('users')->onDelete('set null');
        $table->foreign('assigned_staff_id')->references('id')->on('users')->onDelete('set null');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('gbv_cases');
    }
};
