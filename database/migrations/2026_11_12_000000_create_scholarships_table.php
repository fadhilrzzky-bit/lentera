<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('scholarships', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->unsignedInteger('quota')->default(0);
            $table->unsignedInteger('applicants')->default(0);
            $table->unsignedInteger('passed_admin')->default(0);
            $table->unsignedInteger('passed_selection')->default(0);
            $table->unsignedInteger('recipients')->default(0);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('scholarships');
    }
};
