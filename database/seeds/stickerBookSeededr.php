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
            $inserted = StickerBook::create($stickerBook);
            $img = Image::make(base64_encode(QrCode::format('png')->size(200)->margin(1)->generate('{ "login": { "stickerBookId": "' . $inserted->stickerBook_id . '" } }')));
            $img = $img->stream();
            Storage::disk('local')->put('public/qrcodes/stickerbooklogin' . $inserted->stickerBook_id . '.png', $img);
        }
    }
}
