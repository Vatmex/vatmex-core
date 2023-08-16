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
        Schema::create('training_notes', function (Blueprint $table) {
            $table->id();
            $table->foreignId('atc_id')->nullable()->references('id')->on('atcs')->onUpdate('cascade')->onDelete('set null');
            $table->integer('created_by');
            $table->text('message');
            $table->boolean('visible_to_student');
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
        Schema::dropIfExists('training_notes');
    }
};
