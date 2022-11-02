<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAPIKeysTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('api_keys', function (Blueprint $table) {
            $table->id();
            $table->text('recaptcha_public_api_key')->nullable();
            $table->text('recaptcha_private_api_key')->nullable();
            $table->longText('twitter_oauth_access_token')->nullable();
            $table->longText('twitter_oauth_access_token_secret')->nullable();
            $table->longText('twitter_consumer_key')->nullable();
            $table->longText('twitter_consumer_secret')->nullable();
            $table->longText('soundcloud_api_key')->nullable();
            $table->longText('facebook_cookies')->nullable();
            $table->longText('instagram_cookies')->nullable();
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
        Schema::dropIfExists('api_keys');
    }
}
