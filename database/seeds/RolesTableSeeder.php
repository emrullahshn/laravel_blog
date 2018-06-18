<?php

use App\User;
use Illuminate\Database\Seeder;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      DB::table('roles')->truncate();
      // Create Admin role
      $admin = new \App\Role();
      $admin->name = "admin";
      $admin->display_name = "Admin";
      $admin->save();
      
      // Create editor role
      $editor = new \App\Role();
      $editor->name = "editor";
      $editor->display_name = "Editör";
      $editor->save();
      
      // Create Author role
      $author = new \App\Role();
      $author->name = "author";
      $author->display_name = "Yazar";
      $author->save();
      
      // Attach the roles
      $user1 = User::find(1);
      $user1->detachRole($admin);
      $user1->attachRole($admin);
      $user2 = User::find(2);
      $user2->detachRole($editor);
      $user2->attachRole($editor);
      $user3 = User::find(3);
      $user3->detachRole($author);
      $user3->attachRole($author);
    }
}
