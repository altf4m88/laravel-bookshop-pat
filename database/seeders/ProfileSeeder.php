<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProfileSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('tbl_setting_lap')->insert([
            'nama_perusahaan' => 'PT. Buku Jaya Makmur',
            'alamat' => 'Jl. Jalan',
            'no_tlpn' => '666-0-555',
            'web' => 'www.jamur.id',
            'logo' => 'book.png',
            'no_hp' => '0898374923',
            'email' => 'jamur@mail.com',
            'updated_at' => Carbon::now(),
            'created_at' => Carbon::now(),
        ]);
        
    }
}
