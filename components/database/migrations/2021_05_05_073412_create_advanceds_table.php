<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAdvancedsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('advanceds', function (Blueprint $table) {
            $table->id();
            $table->longText('insert_header')->nullable();
            $table->boolean('header_status')->default(true);
            $table->longText('insert_footer')->nullable();
            $table->boolean('footer_status')->default(true);
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
        Schema::dropIfExists('advanceds');
    }
}
