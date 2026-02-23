<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PolicySection extends Model
{
    use \Illuminate\Database\Eloquent\Factories\HasFactory;

    protected $fillable = ['title', 'content', 'order', 'is_active'];
}
