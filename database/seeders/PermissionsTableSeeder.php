<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class PermissionsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('permissions')->delete();
        
        \DB::table('permissions')->insert(array (
            0 => 
            array (
                'id' => 2,
                'name' => 'permission-create',
                'guard_name' => 'web',
                'created_at' => '2022-09-21 13:56:21',
                'updated_at' => '2022-09-21 13:56:21',
            ),
            1 => 
            array (
                'id' => 3,
                'name' => 'permission-delete',
                'guard_name' => 'web',
                'created_at' => '2022-09-21 13:56:21',
                'updated_at' => '2022-09-21 13:56:21',
            ),
            2 => 
            array (
                'id' => 4,
                'name' => 'permission-edit',
                'guard_name' => 'web',
                'created_at' => '2022-09-21 13:56:21',
                'updated_at' => '2022-09-21 13:56:21',
            ),
            3 => 
            array (
                'id' => 5,
                'name' => 'permission-index',
                'guard_name' => 'web',
                'created_at' => '2022-09-21 14:01:15',
                'updated_at' => '2022-09-21 14:01:15',
            ),
            4 => 
            array (
                'id' => 6,
                'name' => 'role-index',
                'guard_name' => 'web',
                'created_at' => '2022-09-21 14:32:35',
                'updated_at' => '2022-09-21 14:32:35',
            ),
            5 => 
            array (
                'id' => 7,
                'name' => 'role-create',
                'guard_name' => 'web',
                'created_at' => '2022-09-21 14:32:35',
                'updated_at' => '2022-09-21 14:32:35',
            ),
            6 => 
            array (
                'id' => 8,
                'name' => 'role-delete',
                'guard_name' => 'web',
                'created_at' => '2022-09-21 14:32:35',
                'updated_at' => '2022-09-21 14:32:35',
            ),
            7 => 
            array (
                'id' => 9,
                'name' => 'role-edit',
                'guard_name' => 'web',
                'created_at' => '2022-09-21 14:32:35',
                'updated_at' => '2022-09-21 14:32:35',
            ),
            8 => 
            array (
                'id' => 10,
                'name' => 'admin-index',
                'guard_name' => 'web',
                'created_at' => '2022-09-22 01:14:47',
                'updated_at' => '2022-09-22 01:14:47',
            ),
            9 => 
            array (
                'id' => 11,
                'name' => 'admin-create',
                'guard_name' => 'web',
                'created_at' => '2022-09-22 01:14:47',
                'updated_at' => '2022-09-22 01:14:47',
            ),
            10 => 
            array (
                'id' => 12,
                'name' => 'admin-edit',
                'guard_name' => 'web',
                'created_at' => '2022-09-22 01:14:47',
                'updated_at' => '2022-09-22 01:14:47',
            ),
            11 => 
            array (
                'id' => 13,
                'name' => 'admin-delete',
                'guard_name' => 'web',
                'created_at' => '2022-09-22 01:14:47',
                'updated_at' => '2022-09-22 01:14:47',
            ),
        ));
        
        
    }
}