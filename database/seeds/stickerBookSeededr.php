<?php

use Illuminate\Database\Seeder;
use App\StickerBook;
class stickerBookSeededr extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('stickerBooks')->delete();
        $stickerBooks = [
            ['numberOfStickers' => 15],
            ['numberOfStickers' => 25]
        ];
        foreach ($stickerBooks as $stickerBook) {
            StickerBook::create($stickerBook);
        }
    }
}
