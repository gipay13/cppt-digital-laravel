<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('cppts', function (Blueprint $table) {
            $table->unsignedBigInteger('diagnose_id')->after('hospital_id')->constrained()->cascadeOnDelete()->restrictOnUpdate();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('cppts', function (Blueprint $table) {
            $table->bigInteger('diagnose_id');
        });
    }
};
