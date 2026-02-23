<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ContactItem extends Model
{
    use \Illuminate\Database\Eloquent\Factories\HasFactory;

    protected $fillable = ['label', 'value', 'icon', 'order', 'is_active'];
}
