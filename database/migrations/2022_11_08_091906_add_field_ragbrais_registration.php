<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddFieldRagbraisRegistration extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('registrants', function (Blueprint $table) {
            $table->integer('ragbrais')->default(0);
		});
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
	    try{
        Schema::table('registrants', function (Blueprint $table) {
	        $table->dropColumn('ragbrais');
        });
        }catch(\Exception $e) {
	        
        }
    }
}
