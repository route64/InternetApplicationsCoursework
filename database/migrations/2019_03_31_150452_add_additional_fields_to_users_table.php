<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddAdditionalFieldsToUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('address')->unique();
            $table->enum('type', ['USER', 'STAFF'])->default('USER');
            $table->enum('title', ['MISS', 'MS', 'MRS', 'MR', 'SIR', 'DR']);
	    		$table->string('post_code');
	    		$table->bigInteger('phone_no'); 
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) { 
            $table->dropColumn('address');
            $table->dropColumn('type');
            $table->dropColumn('post_code');
            $table->dropColumn('phone_no');
        });
    }
}
