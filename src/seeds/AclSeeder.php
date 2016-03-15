<?php

use Illuminate\Database\Seeder;
use Bican\Roles\Models\Role;

class AclSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
       DB::table('roles')->insert([
          'name' => 'Admin',
           'slug' => 'admin',
           'description' => 'Admin role',
           'level' => PHP_INT_MAX
       ]);
    }
}
