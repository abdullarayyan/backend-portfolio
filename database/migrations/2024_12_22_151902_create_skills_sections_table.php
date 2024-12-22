<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSkillsSectionsTable extends Migration
{
    public function up()
    {
        Schema::create('skills_sections', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('subtitle');
            $table->text('description');
            $table->timestamps();
        });

        // Add a foreign key to the skills table for the relation
        Schema::table('skills', function (Blueprint $table) {
            $table->foreignId('skills_section_id')->nullable()->constrained('skills_sections')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::table('skills', function (Blueprint $table) {
            $table->dropForeign(['skills_section_id']);
            $table->dropColumn('skills_section_id');
        });

        Schema::dropIfExists('skills_sections');
    }
}
