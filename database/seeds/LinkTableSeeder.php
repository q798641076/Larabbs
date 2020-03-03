<?php

use App\Models\Link;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
class LinkTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $link=factory(Link::class)->times(5)->make()->toArray();
        DB::table('links')->insert($link);
    }
}
