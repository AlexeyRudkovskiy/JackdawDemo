<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddVideoIdToPostsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('posts', function (Blueprint $table) {
            $connection = env('DB_CONNECTION');
            if ($connection === 'sqlite') {
                $table->unsignedBigInteger('video_id')->default(0);
            } else {
                $table->unsignedBigInteger('video_id');
                $table->foreign('video_id')->references('id')->on('videos')->onDelete('cascade');
            }
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('posts', function (Blueprint $table) {
            $connection = env('DB_CONNECTION');
            $table->dropColumn('video_id');
            if ($connection !== 'sqlute') {
                $table->dropForeign(['video_id']);
            }
        });
    }
}
