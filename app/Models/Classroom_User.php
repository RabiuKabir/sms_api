<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Classroom_User extends Model
{
    use HasFactory;

    protected $fillable = [
        "classroom_id",
        "user_id",
    ];


}
