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
        Schema::create('case_assignments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('case_id')->constrained('gbv_cases');
            $table->foreignId('assigned_user_id')->constrained('users');
            $table->foreignId('assigned_role_id')->constrained('roles');
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
        Schema::dropIfExists('case_assignments');
    }
};
