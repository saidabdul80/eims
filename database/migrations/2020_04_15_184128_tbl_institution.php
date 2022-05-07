<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class TblInstitution extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tbl_tiship_institutions', function (Blueprint $table) {
            $table->id();
            $table->string("name");
            $table->string("sortCode")->nullable();        
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
        Schema::table('tbl_tiship_institutions', function (Blueprint $table) {
            $table->dropSoftDeletes();
        });
        Schema::dropIfExists('tbl_tiship_institutions');
    }
}
