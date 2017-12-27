<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;

class Child extends Model
{
    protected $table = 'children';
    protected $primaryKey = 'child_id';
    
    public function getChildWithParentId($parent_id){

        return DB::table('children')
        ->where('parent_id','=',$parent_id)
        ->get();
    }
    public function parent(){
        return $this->belongsTo('App\User');
    }
}
