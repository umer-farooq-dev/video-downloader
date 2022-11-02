<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Admin\Header;
use DateTime;
class HeaderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
          Header::create(array(
            "id"            => 1,
            "logo"          => url('/') . "/assets/img/logo-header.png",
            "favicon"       => url('/') . "/assets/img/favicon.png",
            "sticky_header" => 1,
            "created_at"    => new DateTime()
          ));
    }
}
