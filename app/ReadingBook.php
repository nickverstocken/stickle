<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;

class ReadingBook extends Model
{
    protected $table = 'readingBooks';
    protected $primaryKey = 'readingBook_id';

    public function getBookWithUserId($user_id){

        return DB::table('readingBooks')
        ->where('addedBy_id','=',$user_id)
        ->get();
    }
}
