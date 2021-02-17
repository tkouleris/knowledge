<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Video extends Model
{
    use HasFactory;

    protected $table = 'video';

    protected $fillable = [
        'url',
        'title',
        'description',
        'knowledge_id',
    ];
}
