<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Projects;
use App\Models\MultiItems;
use App\Models\Items;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class MultiItemSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        MultiItems::factory()
            ->count(5)
            ->has(
              Items::factory()
                  ->count(5)
                  ,"items")
            ->has(
              Projects::factory()
                ->count(1)
                , "project"
              )
            ->create();
    }
}
