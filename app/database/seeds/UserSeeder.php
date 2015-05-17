<?php

class UserSeeder
  extends DatabaseSeeder
{
  public function run()
  {
    $users = [
      [
        "username" => "admin",
        "password" => Hash::make("admin123"),
        "email"    => "chris@example.com"
      ]
    ];

    foreach ($users as $user) {
      User::create($user);
    }
  }
}
