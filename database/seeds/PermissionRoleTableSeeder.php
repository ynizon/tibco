<?php

use Illuminate\Database\Seeder;
use TCG\Voyager\Models\Permission;
use TCG\Voyager\Models\Role;

class PermissionRoleTableSeeder extends Seeder
{
    /**
     * Auto generated seed file.
     *
     * @return void
     */
    public function run()
    {
        $role = Role::where('name', 'admin')->firstOrFail();

        $permissions = Permission::all();

        $role->permissions()->sync(
            $permissions->pluck('id')->all()
        );
		
		/*
		$role = Role::where('name', 'user')->firstOrFail();
		$role->givePermissionTo(Permission::find(1));//Browse admin
		
		for ($i=42; $i<=46;$i++){
			$permissions[]= Permission::find($i);//customers
		}
		
		for ($i=42; $i<=46;$i++){
			$permissions[]= Permission::find($i);//quotations
		}
		*/

    }
}
