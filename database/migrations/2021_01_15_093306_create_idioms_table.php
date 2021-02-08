<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateIdiomsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('idioms', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('meaning')->default('');
            $table->integer('trivia_cart')->default(0);
            $table->integer('trivia_level')->default(0);
            $table->integer('trivia_attempts')->default(0);
            $table->timestamp('last_attempt')->nullable();
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
        Schema::dropIfExists('idioms');
    }
}
