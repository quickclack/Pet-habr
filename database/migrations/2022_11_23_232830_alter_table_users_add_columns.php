<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('description')
                ->after('email')
                ->nullable();

            $table->string('sex')
                ->after('description')
                ->nullable();

            $table->string('avatar')
                ->after('sex')
                ->nullable();
        });
    }

    public function down(): void
    {
        if (app()->isLocal()) {
            Schema::table('users', function (Blueprint $table) {
                $table->dropColumn('description');
                $table->dropColumn('sex');
                $table->dropColumn('avatar');
            });
        }
    }
};
