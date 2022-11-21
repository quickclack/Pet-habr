<?php

use Domain\Information\Models\Article;
use Domain\Information\Models\Tag;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('article_tag', function(Blueprint $table) {
          $table->dropForeign(['article_id']);
          $table->dropForeign(['tag_id']);
          $table->foreign('article_id')
             ->references('id')->on('articles')
             ->onDelete('cascade')
             ->onUpdate('cascade')
             ->change();
          $table->foreign('tag_id')
             ->references('id')->on('tags')
             ->onDelete('cascade')
             ->onUpdate('cascade')
             ->change();
        });
    }

    public function down(): void
    {
        if (app()->isLocal()) {
        Schema::table('article_tag', function(Blueprint $table) {
          $table->dropForeign(['article_id']);
          $table->dropForeign(['tag_id']);

          $table->foreign('article_id')
             ->references('id')->on('articles')
             ->onDelete('set null')
             ->onUpdate('cascade')
             ->change();
          $table->foreign('tag_id')
             ->references('id')->on('tags')
             ->onDelete('set null')
             ->onUpdate('cascade')
             ->change();
        });
        }
    }
};
