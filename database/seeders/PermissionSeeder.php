<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\UserData;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Spatie\Permission\PermissionRegistrar;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Reset cached roles and permissions
        app()[PermissionRegistrar::class]->forgetCachedPermissions();

        // create permissions
        Permission::create(['name' => 'view dashboard', 'group' => 'dashboard']);
    
        //role create
        $roles = ['chairman', 'md', 'customer'];
        foreach ($roles as $role) {
            $rolei  = Role::create(['name' => $role]);
            if ($role == 'md') {
                $rolei->givePermissionTo('view dashboard');
            }
            if ($role == 'md') {
                $rolei->givePermissionTo('view dashboard');
            }elseif ($role == 'customer') {
                $rolei->givePermissionTo('view dashboard');
            }
            //user create
            $user = new User;
            $user->role_id = $rolei->id;
            $user->username = $role;
            $user->password = bcrypt(123456);
            $user->save();
            //user role
            $user->assignRole($role);
            //userdata
            $user_data = new UserData;
            $user_data->user_id =$user->id; 
            $user_data->name = $role; 
            $user_data->n_id ='001222'; 
            $user_data->phone ='0125458'; 
            $user_data->email ='info@eu.com'; 
            $user_data->address ='Main ID';
            $user_data->p_address ='Main ID';
            $user_data->passport_no ='00125';
            $user_data->country ='Jermany';
            $user_data->photo ='1.jpg'; 
            $user_data->date = date('Y-m-d'); 
            $user_data->save();
        }

    }
}
