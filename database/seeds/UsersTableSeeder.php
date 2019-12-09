<?php

use Illuminate\Database\Seeder;
use App\User;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'nama_pengguna' => 'Aulia Nurhady',
            'email' => 'admin@pos.id',
            'password' => bcrypt('secret'),
            'status' => true
        ]);
    }
}
