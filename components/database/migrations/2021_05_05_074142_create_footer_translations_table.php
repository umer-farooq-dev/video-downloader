<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFooterTranslationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('footer_translations', function (Blueprint $table) {
            $table->id();
            $table->string('locale')->index();
            $table->text('layout')->nullable();
            $table->longText('widget1')->nullable();
            $table->longText('widget2')->nullable();
            $table->longText('widget3')->nullable();
            $table->longText('widget4')->nullable();
            $table->longText('widget5')->nullable();
            $table->longText('bottom_text')->nullable();
            $table->unique(['footer_id', 'locale']);
            $table->foreignId('footer_id')->constrained('footers')->onDelete('cascade');
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
        Schema::dropIfExists('footer_translations');
    }
}
