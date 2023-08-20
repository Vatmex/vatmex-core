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
        Schema::create('training_sessions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('atc_id')->nullable()->references('id')->on('atcs')->onUpdate('cascade')->onDelete('set null');
            $table->string('title');
            $table->integer('created_by');
            $table->dateTime('scheduled_time');
            $table->text('description')->nullable();
            $table->boolean('canceled')->default(false);
            $table->dateTime('cancelation_time')->nullable();
            $table->text('cancelation_motive')->nullable();
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
        Schema::dropIfExists('training_sessions');
    }
};
