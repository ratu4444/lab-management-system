<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTasksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tasks', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('project_id');
            $table->string('name')->nullable();
            $table->date('estimated_start_date');
            $table->date('estimated_completion_date');
            $table->date('start_date')->nullable();
            $table->date('completion_date')->nullable();
            $table->integer('status')->default(1)->comment('1 = Pending, 2 = In Progress, Completed, Canceled');
            $table->bigInteger('total_budget')->nullable();
            $table->integer('completion_percentage')->default(0);
            $table->integer('parent_id')->nullable();
            $table->longText('comment')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tasks');
    }
}
