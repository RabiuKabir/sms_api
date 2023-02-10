<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Exam extends Model
{
    use HasFactory;

   protected $fillable = [
        'date',
        'name',
        'type'
   ];



     public function results()
     {
          return $this->hasMany(Result::class);
     }
    
}
