<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Sticker extends Model
{
    protected $table = 'stickers';
    protected $primaryKey = 'sticker_id';
    public function stickerBook(){
        return $this->belongsTo(StickerBook::class, 'stickerBook_id');
    }
}
