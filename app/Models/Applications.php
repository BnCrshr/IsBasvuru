<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Applications extends Model
{
    protected $table = 'applications';

    public function applicatecategorys()
    {
      return  $this->hasOne(JobPosts::class,'id','job_post_id');
    }

    public function comments()
    {
      return  $this->hasMany(Comments::class,'application_id','id');
    }

    public function inspectDefaultQuestions()
    {
      return  $this->hasMany(JobPostQuestions::class,'job_post_id','job_post_id')->where('type', 1);
    }

    public function inspectQuestions()
    {
      return  $this->hasMany(JobPostQuestions::class,'application_id','id');
    }

    public function inspectAnswers()
    {
      return  $this->hasMany(Answers::class,'applications_id','id');
    }

}
