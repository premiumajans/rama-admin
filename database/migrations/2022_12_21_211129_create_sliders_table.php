<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('sliders', function (Blueprint $table) {
            $table->id();
            $table->text('photo');
            $table->text('alt')->nullable();
            $table->boolean('status')->default(1);
            $table->integer('order');
            $table->timestamps();
        });
    }
    public function down()
    {
        Schema::dropIfExists('sliders');
    }
};
