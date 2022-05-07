<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class TishipEnrolleeHistory extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tiship_enrollee_histories', function (Blueprint $table) {

            $table->id();                 
            $table->integer('tiship_enrollee_id');
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
        Schema::dropIfExists('tiship_enrollee_histories');        
    }
}
