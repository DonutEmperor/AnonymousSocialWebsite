<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('comments', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('thread_id');
            $table->text('body');
            $table->timestamps();
            $table->integer('upvotes')->default(0);
            $table->integer('downvotes')->default(0);
            $table->integer('report_count')->default(0);
        });

        Schema::table('comments', function (Blueprint $table) {
            $table->foreign('thread_id')->references('id')->on('threads')->onDelete('cascade');;
        });
    }

    public function down()
    {
        Schema::dropIfExists('comments');
    }
};
