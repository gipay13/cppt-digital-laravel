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
        Schema::create('soap_templates', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->text('subjective');
            $table->text('objecttive');
            $table->text('assessment');
            $table->text('plan');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('soap_templates');
    }
};
