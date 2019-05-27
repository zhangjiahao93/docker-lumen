<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLogTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('log', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('type')->nullable(false)->unsigned()->comment('记录类型1');
            $table->integer('key')->nullable(false)->unsigned()->comment('记录类型2');
            $table->dateTime('started_at')->comment('开始时间');
            $table->dateTime('finished_at')->comment('结束时间');
            $table->string('value')->comment('记录数值');
            $table->string('description')->comment('描述');
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
        Schema::dropIfExists('log');
    }
}
