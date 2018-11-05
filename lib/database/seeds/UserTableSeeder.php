<?php

use App\Role;
use App\User;
use Illuminate\Database\Seeder;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $role_employee = Role::where('name', 'employee')->first();
        $role_manager  = Role::where('name', 'manager')->first();
        $employee = new User();
        $employee->email = 'abc@gmail.com';
        $employee->password = bcrypt('0123');
        $employee->save();
        $employee->roles()->attach($role_employee);
        $manager = new User();
        $manager->email = 'admin@app.com';
        $manager->password = bcrypt('0123');
        $manager->save();
        $manager->roles()->attach($role_manager);
  }
}
