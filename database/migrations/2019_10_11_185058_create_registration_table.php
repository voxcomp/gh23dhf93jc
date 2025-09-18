<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('registrants', function (Blueprint $table) {
            $table->increments('id');
            $table->string('invoice', 50)->default('');
            $table->string('fname', 50)->default('');
            $table->string('lname', 75)->default('');
            $table->string('gender', 20)->default('');
            $table->date('dob');
            $table->string('address', 200)->nullable()->default('');
            $table->string('city', 75)->nullable()->default('');
            $table->string('state', 75)->nullable()->default('');
            $table->string('zip', 20)->nullable()->default('');
            $table->string('country', 100)->nullable()->default('');
            $table->string('email', 150)->default('');
            $table->string('phone', 20)->nullable()->default('');
            $table->string('cell', 20)->nullable()->default('');
            $table->string('wristband', 10)->nullable();
            $table->string('group', 75)->nullable()->default('');
            $table->string('econtact', 150)->nullable()->default('');
            $table->string('enumber', 20)->nullable()->default('');
            $table->string('medical', 400)->nullable()->default('');
            $table->string('slug', 200)->nullable();
            $table->date('startdate')->nullable();
            $table->date('enddate')->nullable();
            $table->integer('paid')->default(0);
            $table->string('recumbent', 3)->default('no');
            $table->integer('option')->default(0);
            $table->string('towel', 3)->default('no');
            $table->string('shower', 3)->default('no');
            $table->integer('camping')->default(0);
            $table->string('jersey', 250)->nullable()->default('');
            $table->integer('discount')->default(0);
            $table->string('payid', 40)->default(0);
            $table->string('paytype', 40)->default('');
            $table->string('signature', 140)->default('');
            $table->date('signdate');
            $table->string('adminnotes', 500)->nullable()->default('');
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
        Schema::dropIfExists('registrants');
    }
};
