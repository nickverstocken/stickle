<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;

class ChildrenReadingBook extends Model
{
    protected $table = 'childrenReadingBooks';
    protected $primaryKey = 'childrenReadingBook_id';
    public function Book(){
        return $this->belongsTo(ReadingBook::class, 'book_id');
    }
    public function Child(){
        return $this->belongsTo(Child::class, 'child_id');
    }
}
