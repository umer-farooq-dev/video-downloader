<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Admin\Menu;
use File, DateTime;
class MenuSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $menus = File::get('components/database/contents/menus.json');

        $menus = json_decode($menus);
        
        foreach ($menus as $menu) {

          Menu::create(array(
            "id"         => $menu->id,
            "text"       => $menu->text,
            "url"        => $menu->url,
            "menu_items" => $menu->menu_items,
            "icon"       => $menu->icon,
            "type"       => $menu->type,
            "class"      => $menu->class,
            "parent_id"  => $menu->parent_id,
            "sort"       => $menu->sort,
            "created_at" => new DateTime()
          ));
          
        }

    }
}
