<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class UserMahasiswasTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('user_mahasiswas')->delete();
        
        \DB::table('user_mahasiswas')->insert(array (
            0 => 
            array (
                'id' => 5,
                'user_id' => 9,
                'batch_id' => 6,
                'major_id' => 6,
                'country_id' => 2,
                'nim' => '239131',
                'phone' => '231231',
                'gender' => 'PRIA',
                'created_at' => '2022-09-22 03:18:10',
                'updated_at' => '2022-09-25 01:34:54',
            ),
            1 => 
            array (
                'id' => 6,
                'user_id' => 10,
                'batch_id' => 5,
                'major_id' => 6,
                'country_id' => 2,
                'nim' => '12345678',
                'phone' => '12345678',
                'gender' => 'PRIA',
                'created_at' => '2022-09-24 18:05:20',
                'updated_at' => '2022-09-24 18:05:20',
            ),
            2 => 
            array (
                'id' => 11,
                'user_id' => 14,
                'batch_id' => 3,
                'major_id' => 6,
                'country_id' => 2,
                'nim' => '12345',
                'phone' => '12345',
                'gender' => 'PRIA',
                'created_at' => '2022-09-27 15:43:41',
                'updated_at' => '2022-09-27 15:43:41',
            ),
        ));
        
        
    }
}