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

class ProjectsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $item = Items::factory()
                  ->create();
        Projects::factory()
            ->count(5)
            ->for($item,"latestItem")
            ->create();
    }
}
