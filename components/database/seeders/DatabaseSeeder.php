<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            LanguageSeeder::class,
            TranslationSeeder::class,
            DashboardSeeder::class,
            PageSeeder::class,
            GeneralSeeder::class,
            MenuSeeder::class,
            HeaderSeeder::class,
            FooterSeeder::class,
            APIKeySeeder::class,
            JsonSeeder::class,
            GdprSeeder::class,
            AdvertisementSeeder::class,
            SupportedSiteSeeder::class,
            AdvancedSeeder::class,
            SocialSeeder::class,
        ]);
    }
}
