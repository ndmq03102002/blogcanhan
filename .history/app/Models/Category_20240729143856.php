<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Kalnoy\Nestedset\NodeTrait;
use Illuminate\Database\Eloquent\SoftDeletes;	
class Category extends Model
{
    use HasFactory, NodeTrait, SoftDeletes;

    protected $fillable = ['name', 'description','parent_id'];

    public function posts()
    {
        return $this->belongsToMany(Post::class, 'category');
    }
}
