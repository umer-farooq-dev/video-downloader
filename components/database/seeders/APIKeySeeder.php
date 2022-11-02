<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Admin\APIKeys;
use DateTime;
class APIKeySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
          APIKeys::create(array(
            "id"                                => 1,
            "recaptcha_public_api_key"          => null,
            "recaptcha_private_api_key"         => null,
            "twitter_oauth_access_token"        => null,
            "twitter_oauth_access_token_secret" => null,
            "twitter_consumer_key"              => null,
            "twitter_consumer_secret"           => null,
            "created_at"                        => new DateTime()
          ));
    }
}
