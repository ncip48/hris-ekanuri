<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEmployeesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create(
            'employees', function (Blueprint $table){
            $table->bigIncrements('id');
            $table->integer('user_id')->default('0');
            $table->string('name')->nullable();
            $table->date('dob')->nullable();
            $table->string('gender')->nullable();
            $table->string('phone')->nullable();
            $table->string('address')->nullable();
            $table->string('email')->nullable();
            $table->string('password')->nullable();

            $table->string('employee_id')->default('0');;
            $table->integer('branch_id')->default('0');;
            $table->integer('department_id')->default('0');;
            $table->integer('designation_id')->default('0');;
            $table->string('company_doj')->nullable();
            $table->string('documents')->nullable();

            $table->string('emergency_contact_name')->nullable();
            $table->string('emergency_contact_relation')->nullable();
            $table->string('emergency_contact_address')->nullable();
            $table->string('emergency_contact_phone')->nullable();

            $table->date('educational_start')->nullable();
            $table->date('educational_end')->nullable();
            $table->string('educational_institution')->nullable();
            $table->string('educational_title')->nullable();
            $table->string('educational_mark')->nullable();

            // $table->string('language')->nullable();
            $table->string('language_writing')->nullable();
            $table->string('language_speaking')->nullable();

            $table->date('recent_job_start')->nullable();
            $table->date('recent_job_end')->nullable();
            $table->string('recent_job_position')->nullable();
            $table->string('recent_job_company')->nullable();
            $table->string('recent_job_skill')->nullable();
            $table->string('recent_job_salary')->nullable();

            $table->date('certification_start')->nullable();
            $table->date('certification_end')->nullable();
            $table->string('certification_field')->nullable();
            $table->string('certification_organizer')->nullable();
            $table->string('certification_valid_period')->nullable();
            $table->string('certification_cost')->nullable();

            $table->string('account_holder_name')->nullable();
            $table->string('account_number')->nullable();
            $table->string('bank_name')->nullable();
            $table->string('bank_identifier_code')->nullable();
            $table->string('branch_location')->nullable();
            $table->string('tax_payer_id')->nullable();
            $table->integer('salary_type')->nullable();
            $table->integer('salary')->nullable();
            $table->integer('is_active')->default('1');
            $table->integer('created_by');
            $table->timestamps();
        }
        );
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('employees');
    }
}
