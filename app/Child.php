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
    public function stickerBook(){
        return $this->hasMany('App\StickerBook', 'child_id');
    }
    public function childrenReadingBook(){
        return $this->hasMany('App\ChildrenReadingBook', 'child_id');
    }
    public function currentBook(){
        return $this->hasManyThrough(
            ReadingBook::class, ChildrenReadingBook::class,
            'child_id', 'readingBook_id', 'child_id'
        )->with('childrenReadingBook')->where('currentlyReading', true);
    }
    private function transformAnswersCollection($answers)
    {
        return array_map([$this, 'transformAnswer'], $answers->toArray());
    }

    private function transformAnswer($answer)
    {
        return [
            'question' => QuestionController::transform($answer['survey_question']),
            'answer' => [
                'id' => $answer['id'],
                'value' => $answer['answer']
            ]
        ];
    }
}
