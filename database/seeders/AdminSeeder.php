<?php

namespace Database\Seeders;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'nama' => 'Administrator',
            'email' => 'admin@gmail.com',
            'noreg' => 'admin@gmail.com',
            'password' => Hash::make('admin123'),
            'role' => 'admin',
            'email_verified_at' => Carbon::now()->toDateTimeString()
        ]);

        User::create([
            'nama' => 'Ria Arafiyah S.Si., M.Si',
            'email' => 'riaarafiyah@unj.ac.id',
            'noreg' => '197511212005012004',
            'password' => Hash::make('riaarafiyah123'),
            'role' => 'dosen',
            'email_verified_at' => Carbon::now()->toDateTimeString()
        ]);

        User::create([
            'nama' => 'Ir. Fariani Hermin Indiyah, MT',
            'email' => 'farianigermin@unj.ac.id',
            'noreg' => '196002111987032001',
            'password' => Hash::make('farianihermin123'),
            'role' => 'dosen',
            'email_verified_at' => Carbon::now()->toDateTimeString()
        ]);

        User::create([
            'nama' => 'Ari Hendarno S.Pd., M.Kom',
            'email' => 'arihendarno@unj.ac.id',
            'noreg' => '198811022022031002',
            'password' => Hash::make('arihendarno123'),
            'role' => 'dosen',
            'email_verified_at' => Carbon::now()->toDateTimeString()
        ]);

        User::create([
            'nama' => 'Muhammad Eka Suryana M.Kom',
            'email' => 'ekasuryana@unj.ac.id',
            'noreg' => '198512232012121002',
            'password' => Hash::make('ekasuryana123'),
            'role' => 'dosen',
            'email_verified_at' => Carbon::now()->toDateTimeString()
        ]);

        User::create([
            'nama' => 'Drs. Mulyono M.Kom',
            'email' => 'mulyono@unj.ac.id',
            'noreg' => '196605171994031003',
            'password' => Hash::make('mulyono123'),
            'role' => 'dosen',
            'email_verified_at' => Carbon::now()->toDateTimeString()
        ]);

        User::create([
            'nama' => 'Med Irzal M.Kom',
            'email' => 'medirzal@unj.ac.id',
            'noreg' => '197706152003121001',
            'password' => Hash::make('medirzal123'),
            'role' => 'dosen',
            'email_verified_at' => Carbon::now()->toDateTimeString()
        ]);

        User::create([
            'nama' => 'Dr.rer.nat. Maimun Rizal, ST., M.Sc',
            'email' => 'maimunrizal@unj.ac.id',
            'noreg' => '198005022003121002',
            'password' => Hash::make('maimun123'),
            'role' => 'dosen',
            'email_verified_at' => Carbon::now()->toDateTimeString()
        ]);
    }
}
