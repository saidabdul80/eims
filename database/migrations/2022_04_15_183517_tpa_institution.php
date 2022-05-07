<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class TpaInstitution extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tbl_tpa_institution', function (Blueprint $table) {

            $table->id();                 
            $table->integer('tpa_id');
            $table->integer('institution_id');
            $table->integer('session_id');
            $table->softDeletes();
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
        Schema::table('tbl_tpa_institution', function (Blueprint $table) {
            $table->dropSoftDeletes();
        });    
        Schema::dropIfExists('tbl_tpa_institution');        
    }
}
