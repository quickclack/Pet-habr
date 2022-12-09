<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('comments', function (Blueprint $table) {
            $table->unsignedBigInteger('parent_id')
                ->after('user_id')
                ->nullable();
        });
    }

    public function down(): void
    {
        if (app()->isLocal()) {
            Schema::table('comments', function (Blueprint $table) {
                $table->dropColumn('parent_id');
            });
        }
    }
};
