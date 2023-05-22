<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('mail_lists', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id');
            $table->text('title');
            $table->text('content');
            $table->longText('sent_users');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('mail_lists');
    }
};
