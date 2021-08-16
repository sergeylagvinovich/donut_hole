<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTableDepartmentEmployees extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('department_employees', function (Blueprint $table) {
            $table->id();
            $table->integer('id_department');
            $table->integer('id_employees');
            $table->timestamps();

            $table->foreign('id_department')->on('departments')->references('id')->onDelete('RESTRICT');
            $table->foreign('id_employees')->on('employees')->references('id')->onDelete('CASCADE');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('department_employees');
    }
}
