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
                'photo' => NULL,
            ),
            1 => 
            array (
                'id' => 9,
                'name' => 'Satrio',
                'email' => 'satriotol23@gmaiwda.co',
                'email_verified_at' => NULL,
                'password' => '$2y$10$2x9UdM5gv5UafIdNMw.m5uyOUu3.WGxKGr5qVOgFo4EhClWx6ODNi',
                'remember_token' => NULL,
                'created_at' => '2022-09-22 03:18:10',
                'updated_at' => '2022-09-26 14:27:34',
                'photo' => 'file/09262022142734-Profile 2.png',
            ),
            2 => 
            array (
                'id' => 10,
                'name' => 'satriotol',
                'email' => 'otol@gmail.com',
                'email_verified_at' => NULL,
                'password' => '$2y$10$bzWa1Rx8nkWZR3.Uh4B4megww4GvHYZLdMHzo6irC11BtihzMaGG2',
                'remember_token' => NULL,
                'created_at' => '2022-09-24 18:05:20',
                'updated_at' => '2022-09-25 13:56:41',
                'photo' => 'file/09252022135641-196405162000121002.bmp',
            ),
            3 => 
            array (
                'id' => 11,
                'name' => 'aaa',
                'email' => 'admin@admin.com',
                'email_verified_at' => NULL,
                'password' => '',
                'remember_token' => NULL,
                'created_at' => '2022-09-26 13:09:53',
                'updated_at' => '2022-09-27 13:59:59',
                'photo' => NULL,
            ),
            4 => 
            array (
                'id' => 12,
                'name' => 'Satrio Mahasiswa',
                'email' => 'satriomahasiswa@gmail.com',
                'email_verified_at' => NULL,
                'password' => '$2y$10$Ol1WL0NZoFoCjhQ4f/H9T.J5kKMpIaGRpBVHfMfOmwfRPdbMGczzO',
                'remember_token' => NULL,
                'created_at' => '2022-09-27 14:49:25',
                'updated_at' => '2022-09-27 14:49:25',
                'photo' => NULL,
            ),
        ));
        
        
    }
}