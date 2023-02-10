<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Result extends Model
{
    use HasFactory;

    protected $fillable = [
        "exam_id",
        "user_id",
        "subject_id",
        "marks"
    ];



    public function users()
    {
        return $this->belongsTo(User::class);
    }

    
}
