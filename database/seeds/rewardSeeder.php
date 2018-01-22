<?php

use Illuminate\Database\Seeder;
use App\Reward;
class rewardSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('rewards')->delete();
        $rewards = [
            ['link' => 'https://www.youtube.com/watch?v=-yz-PUv6bTo','title' => 'Mickey Mouse and The Hulk', 'price'=> 2],
            ['link' => 'https://www.youtube.com/watch?v=AO6o_eNN_1U','title' => 'Spiderman vs. Shark', 'price'=> 4] ,
            ['link' => 'https://www.youtube.com/watch?v=3M7ZQPFiKfA','title' => 'Spiderman, This Incredibles, The Hulk racing!', 'price'=> 2],
            ['link' => 'https://www.youtube.com/watch?v=XYQTRJ4Z_Zo','title' => 'The Avengers ', 'price'=> 2],
            ['link' => 'https://www.youtube.com/watch?v=5MBqfxG8X4k','title' => 'Big hero 6', 'price'=> 2],
            ['link' => 'https://www.youtube.com/watch?v=SZ_iyvwHknU','title' => 'Bumba aflevering 103', 'price'=> 1],
            ['link' => 'https://www.youtube.com/watch?v=o_S4t2b1YBI','title' => 'Bumba aflevering 64', 'price'=> 1],
            ['link' => 'https://www.youtube.com/watch?v=r_j1GzIFCEk','title' => 'Peppa Big aflevering 3', 'price'=> 3],
            ['link' => 'https://www.youtube.com/watch?v=hyTNGkBSjyo','title' => 'Pingu aflevering 1', 'price'=> 1],
            ['link' => 'https://www.youtube.com/watch?v=84H_fZ7bRXY','title' => 'Pingu aflevering 2', 'price'=> 1],
            ['link' => 'https://www.yiv.com/games/Speed-Racer/index.html', 'title' => 'Street Racer spelletje', 'price' => 5, 'kind' => 'game', 'picturePath' => '/images/games/speedRacer.png'],
            ['link' => 'http://cdn.gameplayer.io/embed/576742227280298086/?ref=html5gameshub.com', 'title' => 'Tomb runner spelletje', 'price' => 10, 'kind' => 'game', 'picturePath' => '/images/games/tombrunner.jpg'],
            ['link' => 'http://cdn.gameplayer.io/embed/576742227280298414/?ref=html5gameshub.com', 'title' => 'Sun Beams spelletje', 'price' => 5, 'kind' => 'game', 'picturePath' => '/images/games/sunbeams.png'],
            ['link' => 'http://cdn.gameplayer.io/embed/576742227280294550/?ref=html5gameshub.com', 'title' => 'Frizzle Fraz spelletje', 'price' => 5, 'kind' => 'game', 'picturePath' => '/images/games/frizzlefraz.png'],
            ['link' => 'http://cloudgames.com/games/html5/giant-hamster-run-en-s/index.html', 'title' => 'Giant Hamster spelletje', 'price' => 5, 'kind' => 'game', 'picturePath' => '/images/games/gianthamster.png'],
        ];
        foreach ($rewards as $reward) {
            Reward::create($reward);
        }
    }
}
