<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (Schema::hasTable('fillers')) {
            return;
        }

        Schema::create('fillers', function (Blueprint $table) {
            $table->id();
            $table->string('filler');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('fillers');
    }
};
