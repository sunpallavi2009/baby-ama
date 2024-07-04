<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddPrescriptionNameAndTypeToDoctorPrescriptionMedicinesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('doctor_prescription_medicines', function (Blueprint $table) {
            $table->string('prescription_name')->nullable()->before('prescription_id');
            $table->string('type')->nullable()->before('prescription_id');
            $table->string('dosage_qty')->nullable()->before('total_qty');
            
            
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('doctor_prescription_medicines', function (Blueprint $table) {
            //
        });
    }
}
