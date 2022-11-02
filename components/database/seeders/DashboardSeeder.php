<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Admin\Downloads;
use DateTime;
class DashboardSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
          Downloads::create(array(
            "id"         => 1,
            "source"     => "Youtube",
            "thumbnail"  => asset('assets/img/nastuh.jpg'),
            "link"       => "https://www.youtube.com/watch?v=O9UgaCWN2Ag",
            "client_ip"  => '127.0.0.1',
            "created_at" => new DateTime()
          ));
    }
}
