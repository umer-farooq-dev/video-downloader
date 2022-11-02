<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Admin\Page;
use App\Models\Admin\PageTranslation;
use File, DateTime;
class PageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $pages = File::get('components/database/contents/pages.json');

        $pages = json_decode($pages);
        
        foreach ($pages as $page) {

          switch ( $page->type ) {

            case 'default': 
            case 'home':
            case 'downloader':

                Page::create(array(
                            "id"             => $page->id,
                            "slug"           => $page->slug,
                            "type"           => $page->type,
                            "featured_image" => asset('assets/img/nastuh.jpg'),
                            "created_at"     => new DateTime()
                        ));

                foreach ($page->translations as $pageTran) {

                     PageTranslation::create([
                        "locale"            => $pageTran->locale,
                        "title"             => $pageTran->title,
                        "subtitle"          => $pageTran->subtitle,
                        "short_description" => 'It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout.',
                        "description"       => 'Aenean felis purus, aliquet vel malesuada egestas, iaculis ut odio. Sed posuere cursus fermentum. Aliquam erat volutpat. Aenean efficitur nunc ac lectus pretium, ut semper odio mattis. Aliquam sit amet sapien libero. Sed facilisis bibendum enim.',
                        "page_id"           => $page->id
                    ]);

                }

              break;

            case '404':

                Page::create(array(
                            "id"             => $page->id,
                            "slug"           => $page->slug,
                            "type"           => $page->type,
                            "featured_image" => asset('assets/img/illustrations/error-404.png'),
                            "created_at"     => new DateTime()
                        ));

                foreach ($page->translations as $pageTran) {

                     PageTranslation::create([
                        "locale"            => $pageTran->locale,
                        "title"             => $pageTran->title,
                        "subtitle"          => $pageTran->subtitle,
                        "short_description" => $pageTran->short_description,
                        "description"       => $pageTran->description,
                        "page_id"           => $page->id
                    ]);

                }

              break;

            default:

                Page::create(array(
                  "id"                => $page->id,
                  "slug"              => $page->slug,
                  "type"              => $page->type,
                  "featured_image"    => asset('assets/img/nastuh.jpg'),
                  "created_at"        => new DateTime()
                ));

                foreach ($page->translations as $pageTran) {

                     PageTranslation::create([
                        "locale"            => $pageTran->locale,
                        "title"             => $pageTran->title,
                        "subtitle"          => $pageTran->subtitle,
                        "short_description" => 'It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout.',
                        "description"       => 'Aenean felis purus, aliquet vel malesuada egestas, iaculis ut odio. Sed posuere cursus fermentum. Aliquam erat volutpat. Aenean efficitur nunc ac lectus pretium, ut semper odio mattis. Aliquam sit amet sapien libero. Sed facilisis bibendum enim.',
                        "page_id"           => $page->id
                    ]);

                }

              break;
          }

        }
    }
}
