<?php

use Illuminate\Database\Seeder;

class AdministratorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      $administrator = new \App\User;
      $administrator->username = "administrator";
      $administrator->name = "Site Administrator";
      $administrator->email = "administrator@email.com";
      $administrator->roles = json_encode(["ADMIN"]);
      $administrator->password = \Hash::make("password");
      $administrator->avatar = "admin.png";
      $administrator->address = "Pekalongan";
      $administrator->phone = "12345678";
      $administrator->save();
      $this->command->info("User Admin successfully inserted");
    }
}
