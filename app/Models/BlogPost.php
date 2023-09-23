<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BlogPost extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'content', 'is_published', 'status', 'author_id'];

    public function author() {
        return $this->belongsTo(Author::class);
    }
}
