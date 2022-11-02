<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInstallsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('installs', function (Blueprint $table) {
            $table->id();
            $table->boolean('database')->default(false);
            $table->boolean('admin')->default(false);
            $table->boolean('import')->default(false);
            $table->boolean('finished')->default(false);
            $table->text('token')->nullable();
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
        Schema::dropIfExists('installs');
    }
}
