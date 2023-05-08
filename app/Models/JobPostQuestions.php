<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JobPostQuestions extends Model
{
    protected $fillable = ['job_post_id','question','type','application_id', 'category', 'question_order', 'required_status'];

    protected $table = 'job_post_questions';

    public function answer()
    {
      return  $this->hasOne(Answers::class,'question_id','id');
    }

    public function questionChoices()
    {
      return  $this->hasMany(Choices::class,'question_id','id');
    }
}
