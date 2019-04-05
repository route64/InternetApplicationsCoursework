<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAccountsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('accounts', function (Blueprint $table) {
            $table->increments('id');
            $table->string('type')->default('USER');
            $table->timestamps();
            $table->enum('title', ['MISS', 'MS', 'MRS', 'MR', 'SIR', 'DR']);
	    		$table->string('name');
	    		$table->string('username')->unique();
	    		$table->string('password');
	    		$table->boolean('staff')->default(0);
	    		$table->string('address');
	    		$table->string('post_code');
	    		$table->string('email');
	    		$table->integer('phone_no'); 
	    		
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('accounts');
    }
}
