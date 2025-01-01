<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProjectSectionsTable extends Migration
{
    public function up()
    {
        Schema::create('project_sections', function (Blueprint $table) {
            $table->id();
            $table->foreignId('project_id')->constrained()->onDelete('cascade');
            $table->enum('type', ['normal_section', 'slider_section', 'grid_section']);
            $table->string('title');
            $table->text('description');
            $table->boolean('has_images')->default(false);
            $table->boolean('has_grid_images')->default(false);
            $table->boolean('is_active')->default(true);
            $table->integer('sort')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('project_sections');
    }
}
