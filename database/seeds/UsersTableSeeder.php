<?php

use Faker\Factory;
use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
  /**
   * Run the database seeds.
   *
   * @return void
   */
  public function run()
  {
    // reset the users table
    DB::statement('SET FOREIGN_KEY_CHECKS=0');
    DB::table('users')->truncate();
    
    // generate 3 users/author
    $faker = Factory::create();
    
    DB::table('users')->insert([
      [
        'name' => "Admin Kullanıcı",
        'slug' => 'admin-kullanici',
        'email' => "admin@test.com",
        'password' => bcrypt('123456'),
        'bio' => $faker->text(rand(250,300))
      ],
      [
        'name' => "Editör Kullanıcı",
        'slug' => 'editor-kullanici',
        'email' => "editor@test.com",
        'password' => bcrypt('123456'),
        'bio' => $faker->text(rand(250,300))
      ],
      [
        'name' => "Yazar Kullanıcı",
        'slug' => 'yazar-kullanici',
        'email' => "yazar@test.com",
        'password' => bcrypt('123456'),
        'bio' => $faker->text(rand(250,300))
      ],
    ]);
  }
}
