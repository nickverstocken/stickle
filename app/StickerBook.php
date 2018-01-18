<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class StickerBook extends Model
{
    protected $table = 'stickerBooks';
    protected $primaryKey = 'stickerBook_id';
    public function child(){
        return $this->belongsTo('App\Child', 'child_id');
    }
    public function stickers(){
        return $this->hasMany(Sticker::class, 'stickerBook_id');
    }
}
