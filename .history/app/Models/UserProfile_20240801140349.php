<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserProfile extends Model
{
    use HasFactory;
    use HasFactory;

    protected $fillable = ['name', 'dateofbirth', 'sex', 'address', 'avatar'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}