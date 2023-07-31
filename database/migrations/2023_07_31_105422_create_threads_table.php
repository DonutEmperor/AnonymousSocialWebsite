<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('threads', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('topic_id');
            $table->string('title');
            $table->timestamps();
            $table->integer('upvotes')->default(0);
            $table->integer('downvotes')->default(0);
            $table->integer('report_count')->default(0);
        });

        Schema::table('threads', function (Blueprint $table) {
            $table->foreign('topic_id')->references('id')->on('topics')->onDelete('cascade');;
        });
    }

    public function down()
    {
        Schema::dropIfExists('threads');
    }
};
