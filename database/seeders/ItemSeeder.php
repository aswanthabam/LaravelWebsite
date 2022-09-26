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

class ItemSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Items::factory()
            ->count(10)
            ->create();
    }
}
