<?php

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\Admin;
class SetupSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	//Permission::truncate();
    	//Role::truncate();
    	//Admin::truncate();

        Permission::create(['name' => 'view-dashboard']);
        Permission::create(['name' => 'view-profile']);
        Permission::create(['name' => 'list-servers']);
        Permission::create(['name' => 'delete-servers']);
        Permission::create(['name' => 'edit-servers']);
        Permission::create(['name' => 'create-servers']);
        Permission::create(['name' => 'rekey-servers']);
        Permission::create(['name' => 'list-categories']);
        Permission::create(['name' => 'create-categories']);
        Permission::create(['name' => 'edit-categories']);
        Permission::create(['name' => 'delete-categories']);
        Permission::create(['name' => 'list-players']);
        Permission::create(['name' => 'view-players']);
        Permission::create(['name' => 'ban-players']);
        Permission::create(['name' => 'unban-players']);
        Permission::create(['name' => 'view-players-bans']);
        Permission::create(['name' => 'view-orders']);
        Permission::create(['name' => 'list-products']);
        Permission::create(['name' => 'create-products']);
        Permission::create(['name' => 'edit-products']);
        Permission::create(['name' => 'delete-products']);


		$role = Role::create(['name' => 'full-access']);
        $role->givePermissionTo(Permission::all());

        $a = new Admin;
        $a->name = "MinePoS Admin";
        $a->email = "admin@minepos.net";
        $a->password = \Hash::make("Password123!");
        $a->save();

        $a->assignRole($role);
    }
}
