<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Seeder;

class RoleSedeer extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $roles = [
            [
            'name' => 'admin',
            'redirect_to' => '/dashboard',
            ],
            [
                'name' => 'Pegawai',
                'redirect_to' => '/dashboardPegawai',
                ],
        ];

        foreach ($roles as $role){
            Role::create($role);
        }
    } 
}
