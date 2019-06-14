<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use TCG\Voyager\Models\Role;
use TCG\Voyager\Models\User;

class UsersTableSeeder extends Seeder
{
    /**
     * Auto generated seed file.
     *
     * @return void
     */
    public function run()
    {
        if (User::count() == 0) {
            $role = Role::where('name', 'admin')->firstOrFail();

            User::create([
                'name'           => 'JP Thys',
                'email'          => 'jpthys@gmail.com',
                'password'       => bcrypt('admin'),
                'remember_token' => Str::random(60),
                'role_id'        => $role->id,
            ]);
			
			User::create([
                'name'           => 'Yohann Nizon',
                'email'          => 'ynizon@gmail.com',
                'password'       => bcrypt('admin'),
                'remember_token' => Str::random(60),
                'role_id'        => $role->id,
            ]);
        }
    }
}
