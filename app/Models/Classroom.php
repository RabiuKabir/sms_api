<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Classroom extends Model
{
    use HasFactory;

    protected $fillable = [
        "section",
        "grade",
        "user_id"
    ];



    public function subjects()
    {
        return $this->hasMany(Subject::class);
    }


    public function users()
    {
        return $this->belongsTo(User::class);
    }
    
}


