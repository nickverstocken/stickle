<?php

use Illuminate\Database\Seeder;
use App\User;
class userSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->delete();
        User::create([
            'firstName' => "Nick",
            'lastName' => "Verstocken",
            'email' => "verstockennick@gmail.com",
            'password' => bcrypt('test123'),
            'parentPincode' => 1234
        ]);
    }
}
