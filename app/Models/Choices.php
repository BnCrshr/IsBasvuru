<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Choices extends Model
{
    protected $fillable = ['question_id','choice'];


    protected $table = 'choices';
}
