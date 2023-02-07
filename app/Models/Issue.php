<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Issue extends Model
{
    use HasFactory;


    protected $fillable = [
        'user_id',
        'type',
        'details',
        'is_resolved'
    ];


    public function users()
    {
        return $this->belongsTo(User::class);
    }
}
