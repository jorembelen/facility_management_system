<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateClientAppointmentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('client_appointments', function (Blueprint $table) {
            $table->uuid('id')->primary()->unique();
            $table->uuid('user_id')->nullable();
            $table->string('scheduler_id')->nullable();
            $table->string('building_id');
            $table->bigInteger('work_category_id')->unsigned();
            $table->string('schedule_time');
            $table->text('job_description');
            $table->string('job_location')->nullable();
            $table->string('images')->nullable();
            $table->string('documents')->nullable();
            $table->date('date');
            $table->boolean('status')->default(0); // Open(0), Closed(1), Cancelled(2)
            $table->integer('survey_score')->nullable();
            $table->text('survey_comments')->nullable();
            $table->boolean('survey_status')->default(0);
            $table->string('cancellation_reason')->nullable();
            $table->text('cancellation_comments')->nullable();
            $table->string('emergency_type')->nullable();
            $table->string('closing_attachment')->nullable();
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
        Schema::dropIfExists('client_appointments');
    }
}
