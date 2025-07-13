<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class AlterTypeEnumInProjectSectionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::statement("ALTER TABLE project_sections
        MODIFY COLUMN type ENUM(
            'intro',
            'work_process',
            'outcomes',
            'normal_section',
            'slider_section',
            'grid_section',
            'AfterBefore',
            'numbers'
        ) NOT NULL");
    }


    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('project_sections', function (Blueprint $table) {
            //
        });
    }
}
