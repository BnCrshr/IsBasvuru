<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JobPosts extends Model
{
    protected $table = 'job_post';

    public function questions()
    {
        return $this->hasMany(JobPostQuestions::class, 'job_post_id', 'id')->where('type', 1);
    }

    public function applications()
    {
      return  $this->hasMany(Applications::class,'job_post_id','id')->with('comments');
    }
}
