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
use Illuminate\Database\Eloquent\Factories\Sequence;
class ProjectsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $project = Projects::factory()
                      ->for(
                          Items::factory(),"latestItem"
                        )
                      ->count(10)
                      ->create();
    }
}
