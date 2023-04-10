<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('articlehas_article_category', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('ab_articlecategory_id')
                ->nullable(false);
            $table->foreign('ab_articlecategory_id')
                ->references('id')

                ->on('ab_article_category');
                /**hier noticed */


            $table->bigInteger('ab_article_id')
                ->unique();
            $table->foreign('ab_article_id')
                ->references('id')
                ->on('ab_article');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('articlehas_article_category');
    }
};
