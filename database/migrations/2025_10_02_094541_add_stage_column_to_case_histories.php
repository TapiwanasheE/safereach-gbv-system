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
        Schema::table('case_histories', function (Blueprint $table) {
            $table->string('from_stage')->nullable()->after('status');
            $table->string('to_stage')->nullable()->after('from_stage');
            $table->string('action_type')->nullable()->after('to_stage'); // e.g., 'pushed', 'closed', 'assigned'
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('case_histories', function (Blueprint $table) {
            $table->dropColumn(['from_stage', 'to_stage', 'action_type']);
        });
    }
};
