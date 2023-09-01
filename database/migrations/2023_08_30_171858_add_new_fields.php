<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class () extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('cv')->default('no cv')->after('password');
            $table->string('job_title')->default('no job')->after('cv');
            $table->string('bio')->default('no cv')->after('job_title');
            $table->string('twitter')->default('no twitter')->after('bio');
            $table->string('facebook')->default('no facebook')->after('twitter');
            $table->string('linkedin')->default('no linkedin')->after('facebook');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            //
        });
    }
};
