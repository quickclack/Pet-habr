<?php

use Domain\Information\Models\Article;
use Domain\User\Models\User;
use Domain\Information\Models\Tag;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('user_favorite_articles', function (Blueprint $table) {
            //$table->id();

            $table->foreignIdFor(Article::class)
                ->constrained()
                ->cascadeOnUpdate()
                ->cascadeOnDelete();

            $table->foreignIdFor(User::class)
                ->constrained()
                ->cascadeOnUpdate()
                ->cascadeOnDelete();

            $table->primary(['user_id', 'article_id']);
            $table->timestamps();
            $table->dropColumn('updated_at');
        });
    }

    public function down(): void
    {
        if (app()->isLocal()) {
            Schema::dropIfExists('user_favorite_articles');
        }
    }
};
