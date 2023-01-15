<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('notifications', function (Blueprint $table) {
            $table->integer('article_id')
                ->nullable()
                ->after('notification_type_id');

            $table->integer('comment_id')
                ->nullable()
                ->after('article_id');
        });
    }

    public function down(): void
    {
        if (app()->isLocal()) {
            Schema::table('notifications', function (Blueprint $table) {
                $table->dropColumn('article_id');
                $table->dropColumn('comment_id');
            });
        }
    }
};
