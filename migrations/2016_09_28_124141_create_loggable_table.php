<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLoggableTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create(config('loggable.table_name'), function (Blueprint $table) {
            $table->increments('id');
            $table->json('metadata');
            $table->integer('user_id')->unsigned()->nullable();
            $table->integer('loggable_id')->unsigned();
            $table->string('loggable_type');
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('user_id')->references(config('loggable.users_table_id'))->on(config('loggable.users_table'));
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop(config('loggable.table_name'));
    }
}
