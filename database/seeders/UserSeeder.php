<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
  /**
   * Run the database seeds.
   *
   * @return void
   */
  public function run()
  {
    // Create the first user
    User::create([
      'name' => 'Admin',
      'email' => 'admin@smartcity.com',
      'password' => Hash::make('Admin@1990')
    ]);

    // Create two more users
    User::create([
      'name' => 'Mahmoud Shilbaya',
      'email' => 'mahmoud@smartcity.com',
      'password' => Hash::make('Mahmoud@1990')
    ]);

    User::create([
      'name' => 'Developer',
      'email' => 'developer@smartcity.com',
      'password' => Hash::make('Developer@1990')
    ]);
  }
}
