<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGeneralsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('generals', function (Blueprint $table) {
            $table->id();
            $table->boolean('wave_animation_status')->default(true);
            $table->text('parallax_image')->nullable();
            $table->text('overlay_type')->nullable();
            $table->text('solid_color')->nullable();
            $table->text('gradient_first_color')->nullable();
            $table->text('gradient_second_color')->nullable();
            $table->text('gradient_position')->nullable();
            $table->text('opacity')->nullable();
            $table->text('blur')->nullable();
            $table->text('font_family')->nullable();
            $table->text('font_style')->nullable();
            $table->text('prefix')->nullable();
            $table->text('timezone')->nullable();
            $table->text('default_language')->nullable();
            $table->text('main_color')->nullable();
            $table->boolean('maintenance_mode')->default(true);
            $table->boolean('automatic_language_detection')->default(true);
            $table->boolean('recaptcha_v3')->default(true);
            $table->boolean('language_switcher')->default(true);
            $table->boolean('page_load')->default(true);
            $table->boolean('supported_sites')->default(true);
            $table->boolean('share_icons_status')->default(true);
            $table->boolean('author_box_status')->default(true);
            $table->boolean('social_status')->default(true);
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
        Schema::dropIfExists('generals');
    }
}
