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
        Schema::create('databases', function (Blueprint $table) {
            $table->id();
            $table->string('c_name')->nullable();
            $table->string('c_id')->nullable();
            $table->string('db_name')->nullable();
            $table->string('ip')->nullable();
            $table->integer('port')->nullable();
            $table->string('user')->nullable();
            $table->string('password')->nullable();
            $table->string('backup_max_count')->nullable();
            $table->string('last_backup')->nullable();
            $table->string('period_hour')->nullable();
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
        Schema::dropIfExists('databases');
    }
};
