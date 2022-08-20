<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            // $table->id();
            $table->uuid('id')->primary();
            $table->string('name');
            $table->string('username')->nullable();
            $table->string('role')->default('staff');
            $table->string('email')->unique();
            $table->string('password')->nullable();
            $table->boolean('status')->default(1);
            $table->boolean('upgraded')->default(0);
            $table->boolean('reset')->default(0);

            // $table->string('api_token')->nullable();
            // $table->string('guid')->nullable();
            // $table->string('domain')->nullable();

            $table->string('mobile')->nullable();
            // $table->string('job_title')->nullable();
            // $table->string('description')->nullable();
            // $table->string('department_name')->nullable();
            $table->string('badge')->nullable();
            // $table->string('company')->nullable();
            // $table->string('division')->nullable();
            // $table->text('member_of')->nullable();

            $table->text('profile_photo_path')->nullable();
            $table->softDeletes();
            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
}
