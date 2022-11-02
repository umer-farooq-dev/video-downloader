<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAdvertisementsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('advertisements', function (Blueprint $table) {
            $table->id();
            $table->longText('area1')->nullable();
            $table->boolean('area1_status')->default(true);
            $table->text('area1_align')->nullable();
            $table->text('area1_margin')->nullable();

            $table->longText('area2')->nullable();
            $table->boolean('area2_status')->default(true);
            $table->text('area2_align')->nullable();
            $table->text('area2_margin')->nullable();

            $table->longText('area3')->nullable();
            $table->boolean('area3_status')->default(true);
            $table->text('area3_align')->nullable();
            $table->text('area3_margin')->nullable();

            $table->longText('area4')->nullable();
            $table->boolean('area4_status')->default(true);
            $table->text('area4_align')->nullable();
            $table->text('area4_margin')->nullable();
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
        Schema::dropIfExists('advertisements');
    }
}
