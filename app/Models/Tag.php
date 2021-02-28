<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    use HasFactory;

    protected $table = 'tag';

    protected $fillable = [
        'tag',
        'user_id'
    ];

    // relations
    public function knowledges()
    {
        return $this->belongsToMany(Knowledge::class, 'knowledge_tag', 'tag_id', 'knowledge_id');
    }
}
