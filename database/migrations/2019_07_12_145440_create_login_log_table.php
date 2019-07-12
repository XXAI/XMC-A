<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLoginLogTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('login_log', function (Blueprint $table) {
            $table->bigInteger('user_id')->unsigned();
            $table->string('clues');
            $table->string('ip');
            $table->timestamp('fecha_login')->useCurrent();

            $table->index(['user_id']);
            $table->index(['clues']);
            $table->index(['fecha_login']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('login_log');
    }
}
