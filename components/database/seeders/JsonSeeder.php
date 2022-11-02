<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Admin\Json;
use DateTime;

class JsonSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
          Json::create(array(
            "id"         => 1,
            "status"     => 0,
            "created_at" => new DateTime()
          ));
    }
}
