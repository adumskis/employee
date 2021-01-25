<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

/**
 * Class CreateEmployeesTable
 */
class CreateEmployeesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('employees', function (Blueprint $table) {
            $table->id();
            $table->string('first_name', 50);
            $table->string('last_name', 50);
            $table->date('birth_date');
            $table->date('employment_date');
            $table->string('home_address', 100);
            $table->bigInteger('boss_id')->unsigned()->nullable();
            $table->enum('role', [
                'ceo',
                'project_manager',
                'qa_specialist',
                'support_specialist',
                'developer',
            ]);
            $table->timestamps();

            $table->index('birth_date');

            $table->foreign('boss_id')
                ->references('id')
                ->on('employees')
                ->onDelete('cascade');
        });

        DB::statement('ALTER TABLE `employees` ADD FULLTEXT INDEX first_name_index (first_name)');
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
