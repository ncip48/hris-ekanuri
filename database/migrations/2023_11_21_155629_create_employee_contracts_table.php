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
        Schema::create('employee_contracts', function (Blueprint $table) {
            $table->id();
            // $table->foreignId('employee_id')->constrained();
            $table->integer('employee_id');
            $table->integer('branch_id');
            $table->integer('department_id');
            $table->integer('sub_department_id');
            $table->integer('designation_id');
            $table->date('start_date');
            $table->date('end_date');
            // $table->string('contract_type');
            $table->string('contract_file');
            $table->integer('created_by');
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
        Schema::dropIfExists('employee_contracts');
    }
};
