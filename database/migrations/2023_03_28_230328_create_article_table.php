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
        Schema::create('ab_article', function (Blueprint $table) {
            $table->id();
            $table->string('ab_name', 80)
                ->comment('Name');
            $table->integer('ab_price')
                ->comment('Preis in Cent');
            $table->string('ab_description',1000)
                ->comment('Beschreibung, die die Güte oder die Beschaffenheit näher darstellt. Wird durch den "Ersteller"(ab_user) gepflegt');
            $table->bigInteger('ab_creator_id');
            /**
            noticed*/
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('article');
    }
};
