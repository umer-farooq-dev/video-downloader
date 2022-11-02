<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Admin\General;
use DateTime;
class GeneralSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
          General::create(array(
            "id"                           => 1,
            "wave_animation_status"        => 1,
            "parallax_image"               => null,
            "overlay_type"                 => "gradient",
            "solid_color"                  => "#0d0d0d",
            "gradient_first_color"         => "#642b73",
            "gradient_second_color"        => "#c6426e",
            "gradient_position"            => "to left",
            "opacity"                      => "0.9",
            "blur"                         => "1",
            "font_family"                  => "Montserrat",
            "font_style"                   => "regular",
            "prefix"                       => "VidClear_",
            "timezone"                     => "UTC",
            "default_language"             => "en",
            "main_color"                   => "#cb0c9f",
            "maintenance_mode"             => 0,
            "automatic_language_detection" => 0,
            "recaptcha_v3"                 => 1,
            "page_load"                    => 1,
            "supported_sites"              => 1,
            "share_icons_status"           => 1,
            "author_box_status"            => 1,
            "social_status"                => 1,
            "created_at"                   => new DateTime()
          ));
    }
}
