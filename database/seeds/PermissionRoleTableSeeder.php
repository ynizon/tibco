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
		
		$role = Role::where('name', 'user')->firstOrFail();
		$role->permissions()->detach();
		
		$permissions = ["browse_admin","browse_customers","read_customers","add_customers","edit_customers","delete_customers","browse_quotations","read_quotations","add_quotations","edit_quotations","delete_quotations"];
		foreach ($permissions as $permission){
			$p = Permission::where("key","=",$permission)->first();
			$role->permissions()->attach($p);
		}
		

    }
}
