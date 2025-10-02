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
        Schema::table('gbv_cases', function (Blueprint $table) {
            $table->text('medical_review')->nullable()->after('stage');
            $table->text('medical_findings')->nullable()->after('medical_review');
            $table->text('counseling_notes')->nullable()->after('medical_findings');
            $table->integer('counseling_sessions')->nullable()->after('counseling_notes');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('gbv_cases', function (Blueprint $table) {
            $table->dropColumn(['medical_review', 'medical_findings', 'counseling_notes', 'counseling_sessions']);
        });
    }
};
