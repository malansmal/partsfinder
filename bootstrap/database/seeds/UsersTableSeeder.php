<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('partfinders_users')->insert([
            [
                'id'                =>  101,
                'username'          =>  'admin',
                'password'          =>  bcrypt('Australia2020@'),
                'email'             =>  'md.russel.hussain@gmail.com',
                'full_name'         =>  "Md. Russel Hussain",
                'mobile_no'         =>  "+8801722892459",
                'user_type'         =>  "Admin",
                'created_at'        =>  date('Y-m-d H:i:s'),
                'updated_at'        =>  date('Y-m-d H:i:s'),
            ]
        ]);
    }
}
