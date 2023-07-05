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
        Schema::create('atcs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')
                ->constrained()
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->char('initials', 2);
            $table->boolean('inactive');
            $table->integer('rank');
            $table->boolean('visitor')->default(false);
            $table->boolean('delivery')->default(false);
            $table->boolean('ground')->default(false);
            $table->boolean('tower')->default(false);
            $table->boolean('approach')->default(false);
            $table->boolean('center')->default(false);
            $table->boolean('oceanic')->default(false);
            $table->boolean('management')->default(false);
            $table->integer('last_month_hours')->default(0)->nullable();
            $table->integer('current_month_hours')->default(0)->default();
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
        Schema::dropIfExists('atcs');
    }
};
