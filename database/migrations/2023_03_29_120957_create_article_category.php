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
        Schema::create('ab_article_category', function (Blueprint $table) {
            $table->id();
            $table->string('ab_name', 100)
                ->comment('Name')
                ->unique();
            $table->string('ab_description',1000)
                ->comment('Beschreibung')
                ->nullable();
            $table->integer('ab_parent')
                ->nullable();
            $table->foreign('ab_parent')
                ->references('id')
                ->on('ab_article_category');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('ab_article_category');
    }
};
