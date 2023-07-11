<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = User::factory(1)->create()->each(function ($query) {
            $query->assignRole('admin');
            // $query->givePermissionTo('admin');
        });
        // $user = User::factory(100)->create();
    }
}
