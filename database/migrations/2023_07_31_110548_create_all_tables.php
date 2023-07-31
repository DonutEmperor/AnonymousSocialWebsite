<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('boards', function (Blueprint $table) {
            $table->id();
            $table->string('name');
        });

        Schema::create('topics', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('board_id')->nullable()->default(1);
            $table->string('title');
            $table->string('description');
            // Add the foreign key constraint for 'board_id' in 'topics' table
            $table->foreign('board_id')->references('id')->on('boards')->onDelete('cascade');
        });

        Schema::create('threads', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('topic_id');
            $table->string('title');
            $table->string('content');
            $table->timestamps();
            $table->integer('upvotes')->default(0);
            $table->integer('downvotes')->default(0);
            $table->integer('report_count')->default(0);
            // Add the foreign key constraint for 'topic_id' in 'threads' table
            $table->foreign('topic_id')->references('id')->on('topics')->onDelete('cascade');
        });

        Schema::create('comments', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('thread_id');
            $table->text('body');
            $table->timestamps();
            $table->integer('upvotes')->default(0);
            $table->integer('downvotes')->default(0);
            $table->integer('report_count')->default(0);
            // Add the foreign key constraint for 'thread_id' in 'comments' table
            $table->foreign('thread_id')->references('id')->on('threads')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('comments');
        Schema::dropIfExists('threads');
        Schema::dropIfExists('topics');
        Schema::dropIfExists('boards');
    }
};
