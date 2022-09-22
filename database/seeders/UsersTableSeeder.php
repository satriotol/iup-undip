<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('users')->delete();
        
        \DB::table('users')->insert(array (
            0 => 
            array (
                'id' => 4,
                'name' => 'Satrio',
                'email' => 'satriotol69@gmail.com',
                'email_verified_at' => NULL,
                'password' => '$2y$10$Fl716F6evAxOZ9UCFNN9GeSSFz1XAOflDTzr5MxVmqIsYD/IRSWVy',
                'remember_token' => NULL,
                'created_at' => '2022-09-21 14:42:09',
                'updated_at' => '2022-09-22 01:14:21',
            ),
            1 => 
            array (
                'id' => 9,
                'name' => 'satrio',
                'email' => 'satriotol23@gmaiwda.co',
                'email_verified_at' => NULL,
                'password' => '$2y$10$2x9UdM5gv5UafIdNMw.m5uyOUu3.WGxKGr5qVOgFo4EhClWx6ODNi',
                'remember_token' => NULL,
                'created_at' => '2022-09-22 03:18:10',
                'updated_at' => '2022-09-22 03:29:14',
            ),
        ));
        
        
    }
}