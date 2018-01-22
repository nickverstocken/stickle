<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call(userSeeder::class);
       $this->call(childSeeder::class);
        $this->call(bookSeeder::class);
        $this->call(stickerBookSeededr::class);
        $this->call(stickerSeeder::class);
        $this->call(rewardSeeder::class);
    }
}
