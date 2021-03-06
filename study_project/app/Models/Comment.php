<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;

    protected $fillable = [
        'writer',
        'content',
        'board_id',
        'group_id',
        'order',
        'depth'
    ];
}
