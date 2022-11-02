<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Admin\Advertisement;
use DateTime;
class AdvertisementSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
          Advertisement::create(array(
            "id"           => 1,
            "area1"        => '<img class="img-fluid" src="'.asset('assets/img/728x90.png').'">',
            "area1_status" => 0,
            "area1_align"  => "center",
            "area1_margin" => "10",
            "area2"        => '<img class="img-fluid" src="'.asset('assets/img/728x90.png').'">',
            "area2_status" => 0,
            "area2_align"  => "center",
            "area2_margin" => "10",
            "area3"        => '<img class="img-fluid" src="'.asset('assets/img/728x90.png').'">',
            "area3_status" => 0,
            "area3_align"  => "center",
            "area3_margin" => "10",
            "area4"        => '<img class="img-fluid" src="'.asset('assets/img/728x90.png').'">',
            "area4_status" => 0,
            "area4_align"  => "center",
            "area4_margin" => "10",
            "created_at"   => new DateTime()
          ));
    }
}
