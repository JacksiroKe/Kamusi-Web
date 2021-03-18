<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateQuestionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('questions', function (Blueprint $table) {
            $table->id();
            $table->integer('userid')->default(0);
            $table->integer('category')->default(0);
            $table->integer('level')->default(0);
            $table->string('title')->default('');
            $table->string('answer')->default('');
            $table->string('option1')->default('');
            $table->string('option2')->default('');
            $table->string('option3')->default('');
            $table->string('option4')->default('');
            $table->string('option5')->default('');
            $table->string('option6')->default('');
            $table->string('option7')->default('');
            $table->string('option8')->default('');
            $table->string('option9')->default('');
            $table->string('option10')->default('');
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
        Schema::dropIfExists('questions');
    }
}
