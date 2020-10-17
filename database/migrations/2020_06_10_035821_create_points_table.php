<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePointsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('points', function (Blueprint $table) {
            $table->increments('id');
            $table->double('diemmieng', 5, 2);
            $table->double('diem15', 5, 2);
            $table->double('diem1tiet1', 5, 2);
            $table->double('diem1tiet2', 5, 2);
            $table->double('diemthihk1', 5, 2);
            $table->double('diemthihk2', 5, 2);
            $table->double('hocluc', 5, 2);
            $table->integer('hanhkiem');
            $table->integer('student_id')->unsigned();
            $table->integer('subject_id')->unsigned();
            $table->foreign('student_id')->references('id')->on('students')
                ->onDelete('cascade');
            $table->foreign('subject_id')->references('id')->on('subjects')
                ->onDelete('cascade');
            $table->timestamp('created_at')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->timestamp('updated_at')->default(DB::raw('CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP'));
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('points');
    }
}
