<?php

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RolesAndPermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
	{
    	// Reset cached roles and permissions
        app()['cache']->forget('spatie.permission.cache');

        // create permissions
        
		Permission::create(['name' => 'list servers']);
		Permission::create(['name' => 'create server']);
		Permission::create(['name' => 'view server']);
		Permission::create(['name' => 'delete server']);
		Permission::create(['name' => 'list users']);
		Permission::create(['name' => 'create user']);
		Permission::create(['name' => 'view users']);
		Permission::create(['name' => 'edit user']);
		Permission::create(['name' => 'delete user']);
		Permission::create(['name' => 'view roles']);
		Permission::create(['name' => 'create new role']);
		Permission::create(['name' => 'delete roles']);
		Permission::create(['name' => 'view roles']);
		Permission::create(['name' => 'edit roles']);
		Permission::create(['name' => 'list category']);
		Permission::create(['name' => 'create category']);
		Permission::create(['name' => 'delete category']);
		Permission::create(['name' => 'view category']);
		Permission::create(['name' => 'edit category']);
		Permission::create(['name' => 'list order']);
		Permission::create(['name' => 'edit settings']);

        // create roles and assign existing permissions
        $role = Role::create(['name' => 'Owner']);
        $role->givePermissionTo(Permission::all());


    }
}
