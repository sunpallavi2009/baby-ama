<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDoctorPrescriptionMedicinesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('doctor_prescription_medicines', function (Blueprint $table) {
            $table->id();
            $table->integer('prescription_id')->default(0);
            $table->integer('user_id')->default(0);
            $table->integer('medicine_id')->default(0);
            $table->string('dosage')->nullable();
            $table->string('total_qty')->nullable(); // total tab
            $table->string('intake_qty')->nullable();// inatke qua ioty
            $table->string('timing_when')->nullable();//once , twice
            $table->string('timing_how')->nullable();//Before food ,after food
            $table->string('duration')->nullable(); // 2 days/ 1 Week
            $table->longText('notes')->nullable(); 
            $table->enum('prescription_by', ['1', '2'])->default('1')->nullable();
            $table->enum('prescription_status', ['pending','ignored','delivered'])->default('pending')->nullable();
            $table->integer('appointment_id')->default(0)->nullable();
            $table->integer('invoice_number')->unique()->nullable();

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
        Schema::dropIfExists('doctor_prescription_medicines');
    }
}
