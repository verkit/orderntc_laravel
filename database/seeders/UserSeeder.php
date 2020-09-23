<?php

namespace Database\Seeders;

use App\Models\Sales;
use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::insert([
            'id' => 1,
            'username' => 'hobir',
            'email' => 'hobir@gmail.com',
            'password' => bcrypt('hobir123'),
        ]);

        User::insert([
            'id' => 2,
            'username' => 'pupuhsugiono',
            'email' => 'pupuhsugiono@gmail.com',
            'password' => bcrypt('pupuhsugiono123'),
        ]);

        User::insert([
            'id' => 3,
            'username' => 'roni',
            'email' => 'roni@gmail.com',
            'password' => bcrypt('roni123'),
        ]);

        User::insert([
            'id' => 4,
            'username' => 'rendi',
            'email' => 'rendi@gmail.com',
            'password' => bcrypt('rendi123'),
        ]);

        for ($i=1; $i <= 4; $i++) {
            Sales::whereId($i)->update(['user_id' => $i]);
        }
    }
}
