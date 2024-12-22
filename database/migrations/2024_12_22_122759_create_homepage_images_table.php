<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHomepageImagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('homepage_images', function (Blueprint $table) {
            $table->id();
            $table->foreignId('homepage_id')->constrained()->onDelete('cascade');
            $table->enum('type', ['profile', 'click', 'angle']);
            $table->string('path');
            $table->boolean('is_active')->default(true);
            $table->integer('sort')->nullable();
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
        Schema::dropIfExists('homepage_images');
    }
}
