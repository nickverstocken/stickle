<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ChildrenReward extends Model
{
    protected $table = 'childrenRewards';
    protected $primaryKey = 'childrenReward_id';

    public function Reward(){
        return $this->belongsTo(Reward::class, 'reward_id');
    }
    public function Child(){
        return $this->belongsTo(Child::class, 'child_id');
    }
}
