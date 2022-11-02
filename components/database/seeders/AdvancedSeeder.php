<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Admin\Advanced;
use DateTime;
class AdvancedSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
          Advanced::create(array(
            "id"            => 1,
            "insert_header" => null,
            "header_status" => false,
            "insert_footer" => null,
            "footer_status" => false,
            "created_at"    => new DateTime()
          ));
    }
}
