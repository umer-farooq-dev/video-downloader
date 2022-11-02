<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Admin\SupportedSite;
use File, DateTime;

class SupportedSiteSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $sites = File::get('components/database/contents/sites.json');

        $sites = json_decode($sites);
        
        foreach ($sites as $site) {

          SupportedSite::create(array(
            "id"         => $site->id,
            "title"      => $site->title,
            "link"       => $site->link,
            "image"      => url('/') . $site->image,
            "created_at" => new DateTime()
          ));
          
        }

    }
}
