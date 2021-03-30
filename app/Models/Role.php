<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    use HasFactory;
    protected $guarded = [];
    protected $appends = ['CreatedDate'];

    public function getCreatedDateAttribute()
    {
        return $this->created_at->toDateTimeString();
    }

    // public function users()
    // {
    //     return $this->hasMany(User::class);
    // }
}
