<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOccupanciesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('occupancies', function (Blueprint $table) {
            $table->id();
            $table->string('tenant_id')->nullable();
            $table->string('building_id');
            $table->date('assigned_date')->nullable();
            $table->string('assignedBy')->nullable();
            $table->date('checkin_date')->nullable();
            $table->string('checkedinBy')->nullable();
            $table->text('remarks')->nullable();
            $table->text('assign_attachment')->nullable();
            $table->text('checkin_attachment')->nullable();
            $table->boolean('status')->default(0);
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
        Schema::dropIfExists('occupancies');
    }
}
