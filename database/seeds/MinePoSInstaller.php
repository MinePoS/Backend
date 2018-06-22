<?php

use Illuminate\Database\Seeder;
use App\User;

class MinePoSInstaller extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call(RolesAndPermissionsSeeder::class);
		$u = new User;
		$u->name = "admin";
		$u->email = "admin@minepos.net";
		$u->password = \Hash::make("password");
		$u->save();
    }
}
