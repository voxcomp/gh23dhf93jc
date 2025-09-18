<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddFieldChartersRegistration extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('registrants', function (Blueprint $table) {
            $table->integer('charters')->default(0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        try {
            Schema::table('registrants', function (Blueprint $table) {
                $table->dropColumn('charters');
            });
        } catch (\Exception $e) {

        }
    }
}
