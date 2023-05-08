<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Answers extends Model
{
    protected $fillable = ['question_id', 'answer', 'applications_id'];

    protected $table = 'answers';



    public function answer()
    {
      return  $this->hasMany(JobPostQuestions::class,'id','question_id');
    }

    public function questions()
    {
      return  $this->hasMany(JobPostQuestions::class,'id','question_id');
    }


}
