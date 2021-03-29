<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Blogtag extends Model
{
    use HasFactory;
    protected $guarded = [];
    protected $appends = ['CreatedDate'];

    public function getCreatedDateAttribute()
    {
        return $this->created_at->format('Y-m-d');
    }
}
