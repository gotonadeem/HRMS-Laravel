<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateClientsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('clients', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->integer('user_id');
            $table->string('client_id')->unique();
            $table->string('phone', 30);
            $table->string('website_url', 100)->nullable();
            $table->string('skype_id', 30)->nullable();
            $table->string('facebook_id', 80)->nullable();
            $table->string('street', 191);
            $table->string('state', 80);
            $table->string('zip_code', 20);
            $table->string('country', 80);
            $table->string('status', 20);

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
        Schema::dropIfExists('clients');
    }
}
