<?php

use Illuminate\Database\Seeder;
use App\Sticker;
class stickerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('stickers')->delete();
        $stickers = [
            ['stickerBook_id' => 1],
            ['stickerBook_id' => 1],
            ['stickerBook_id' => 1],
            ['stickerBook_id' => 1],
            ['stickerBook_id' => 1],
            ['stickerBook_id' => 1],
            ['stickerBook_id' => 1],
            ['stickerBook_id' => 2],
            ['stickerBook_id' => 2],
            ['stickerBook_id' => 2],
            ['stickerBook_id' => 2],
            ['stickerBook_id' => 2],
            ['stickerBook_id' => 2],
            ['stickerBook_id' => 2],
            ['stickerBook_id' => 2],
            ['stickerBook_id' => 2],
            ['stickerBook_id' => 2],
        ];
        foreach ($stickers as $sticker) {
            Sticker::create($sticker);
        }
    }
}
