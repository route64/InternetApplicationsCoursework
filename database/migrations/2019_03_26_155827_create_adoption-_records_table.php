<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAdoptionRecordsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('adoption-_records', function (Blueprint $table) {
            $table->timestamps();
            $table->integer('ref_id')->unique();
            $table->string('adopter'); //username of adopter
            $table->integer('adoptee_id'); //id of the pet
            $table->enum('status', ['PENDING', 'ACCEPTED', 'DENIED']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('adoption-_records');
    }
}
