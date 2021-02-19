<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTestsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tests', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedInteger('institution_id');
            $table->unsignedInteger('teaching_unit_id');
            $table->unsignedInteger('offer_type_id');
            $table->unsignedInteger('discipline_id');
            $table->unsignedInteger('subject_id');
            $table->char('state', 2);
            $table->string('city');
            $table->char('year', 4);
            $table->string('jury')->nullable();
            $table->foreign('institution_id')->references('id')->on('institutions')->onDelete('cascade');
            $table->foreign('teaching_unit_id')->references('id')->on('teaching_units')->onDelete('cascade');
            $table->foreign('offer_type_id')->references('id')->on('offer_types')->onDelete('cascade');
            $table->foreign('discipline_id')->references('id')->on('disciplines')->onDelete('cascade');
            $table->foreign('subject_id')->references('id')->on('subjects')->onDelete('cascade');
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
        Schema::dropIfExists('tests');
    }
}
