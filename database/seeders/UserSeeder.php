<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = [
            [
                'nama' => 'Lenin',
                'alamat' => 'Kremlin',
                'telepon' => '6969',
                'status' => 'Bujang',
                'username' => 'lenin',
                'password' => Hash::make('lenin123'),
                'akses' => 'KASIR',
            ],
            [
                'nama' => 'Marx',
                'alamat' => 'Kremlin',
                'telepon' => '6969',
                'status' => 'Bujang',
                'username' => 'marx',
                'password' => Hash::make('marx123'),
                'akses' => 'ADMIN',
            ],
            [
                'nama' => 'Stalin',
                'alamat' => 'Kremlin',
                'telepon' => '6969',
                'status' => 'Bujang',
                'username' => 'stalin',
                'password' => Hash::make('stalin123'),
                'akses' => 'MANAGER',
            ],
        ];

        foreach($users as $user)
        {
            DB::table('tbl_user')->insert($user);
        }
    }
}
