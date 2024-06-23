<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddFieldsInClinicalNotes extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('clinical_notes_form', function (Blueprint $table) {
            $table->integer('appointment_id')->default(0);
            $table->longText('gynacology')->nullable();
            $table->longText('physiotheraphy')->nullable();
            $table->longText('general')->nullable();
            $table->longText('women_wellness')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('clinical_notes_form', function (Blueprint $table) {
            //
        });
    }
}