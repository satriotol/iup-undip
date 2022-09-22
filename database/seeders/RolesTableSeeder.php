<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class RolesTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('roles')->delete();
        
        \DB::table('roles')->insert(array (
            0 => 
            array (
                'id' => 2,
                'name' => 'SUPERADMIN',
                'guard_name' => 'web',
                'created_at' => '2022-09-21 14:27:11',
                'updated_at' => '2022-09-21 14:27:11',
            ),
            1 => 
            array (
                'id' => 3,
                'name' => 'MAHASISWA',
                'guard_name' => 'web',
                'created_at' => '2022-09-21 14:32:09',
                'updated_at' => '2022-09-21 14:32:09',
            ),
        ));
        
        
    }
}