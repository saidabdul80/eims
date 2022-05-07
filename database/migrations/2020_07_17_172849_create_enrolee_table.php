<?php



use Illuminate\Database\Migrations\Migration;

use Illuminate\Database\Schema\Blueprint;

use Illuminate\Support\Facades\Schema;



class CreateEnroleeTable extends Migration

{

    /**

     * Run the migrations.

     *

     * @return void

     */

    public function up()

    {

      /*   Schema::create('tbl_enrolee', function (Blueprint $table) {

            $table->id();

            $table->string('surname');

            $table->string('first_name');

            $table->string('other_name');

            $table->integer('user_id');

            $table->integer('pin');

            $table->string('enrolment_number');

            $table->integer('lga_id');

            $table->timestamps();

            $table->enum('status', ['0', '1'])->default('1');

        }); */

    }



    /**

     * Reverse the migrations.

     *

     * @return void

     */

    public function down()

    {

     /*    Schema::table('tbl_enrolee', function (Blueprint $table) {

            Schema::drop('tbl_enrolee');

        }); */

    }

}

