<?php



use Illuminate\Database\Migrations\Migration;

use Illuminate\Database\Schema\Blueprint;

use Illuminate\Support\Facades\Schema;



class CreateTblTishipEnrollees extends Migration

{

    /**

     * Run the migrations.

     *

     * @return void

     */

    public function up()

    {

        Schema::create('tbl_tiship_enrollees', function (Blueprint $table) {

            $table->id();

            $table->string('matric_number')->unique();
            
            $table->string('first_name');
            
            $table->string('surname');

            $table->string('other_name');

            $table->string('department');

            $table->string('faculty');

            $table->string('dob')->nullable();

            $table->string('phone_number')->nullable();

            $table->string('email_address')->nullable();;            

            $table->string('sex')->nullable();

            $table->string('date_admitted')->nullable();

            $table->string('date_of_graduation')->nullable();
        
            $table->string('next_of_kin_name')->nullable();

            $table->string('next_of_kin_address')->nullable();

            $table->string('next_of_kin_phone_number')->nullable();

            $table->string('medical_history')->nullable();
            $table->integer('institution_id')->nullable();
            $table->integer('session_id')->nullable();
            

            $table->timestamps();

            $table->softDeletes();

            

        });

    }



    /**

     * Reverse the migrations.

     *

     * @return void

     */

    public function down()

    {

        Schema::dropIfExists('tbl_tiship_enrollees');

    }

}

