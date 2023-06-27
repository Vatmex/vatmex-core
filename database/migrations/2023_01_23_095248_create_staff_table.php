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
        Schema::create('staff', function (Blueprint $table) {
            $table->id();
            $table->string('position');
            $table->string('shortcode');
            $table->text('description')->nullable();
            $table->string('email')->nullable();
            $table->foreignId('user_id')->nullable()->references('id')->on('users')->onDelete('set null');
            $table->foreignId('team_id')->nullable()->references('id')->on('teams')->onDelete('set null');
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
        Schema::dropIfExists('staff');
    }
};
