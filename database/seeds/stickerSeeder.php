<?php

use Illuminate\Database\Seeder;
use App\Sticker;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Storage;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
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
        //{ "reward": { "stickerBookId": "1", "rewardId": "2" } }
        $stickers = [];

        for($i = 1; $i <= 50; $i++) {
            $stickers[] = ['stickerBook_id' => 1];

        }
        for ($i = 1;$i <= 50; $i++) {
        $stickers[] = ['stickerBook_id' => 2];
}
        foreach ($stickers as $sticker) {
            $inserted = Sticker::create($sticker);
            $img = Image::make(base64_encode(QrCode::format('png')->size(300)->color(15,110,117)->margin(1)->generate('{ "reward": { "stickerBookId": "'. $inserted->stickerBook_id .'", "rewardId": "'. $inserted->sticker_id .'" } }')));
            $img = $img->stream();
            Storage::disk('local')->put('/qrcodes/stickerbook' . $inserted->stickerBook_id . '/' . $inserted->sticker_id . '.png', $img);
        }
    }
}
