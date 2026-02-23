<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HomePhilosophy extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'icon', 'content', 'order', 'is_active'];
}
