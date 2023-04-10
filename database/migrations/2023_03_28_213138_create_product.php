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
        Schema::create('ab_user', function (Blueprint $table) {
            $table->id();
            $table->string('ab_name', 80)
                ->unique()
                ->comment('Name');
            $table->string('ab_password', 120)
                ->comment('Passwort');
            $table->string('ab_mail',200)
                ->comment('E-Mail-Adresse')
                ->unique();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('product');
    }
};
