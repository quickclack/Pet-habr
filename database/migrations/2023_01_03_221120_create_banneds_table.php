<?php

use Domain\User\Models\User;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('banneds', function (Blueprint $table) {
            $table->id();

            $table->foreignIdFor(User::class)
                ->nullable()
                ->cascadeOnDelete()
                ->cascadeOnUpdate();

            $table->boolean('banned')
                ->default(false);

            $table->timestamp('banned_start')
                ->nullable();

            $table->timestamp('banned_end')
                ->nullable();
        });
    }

    public function down(): void
    {
        if (app()->isLocal()) {
            Schema::dropIfExists('banneds');
        }
    }
};
