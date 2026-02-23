<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class CtUser extends Model
{
    protected $connection = 'mysql3';
    protected $table = 'ct_users_hash';

    protected $fillable = [
        'id',
        'full_name',
        'pwd',
        'approved',
        'npk',
        'dept',
        'sect',
        'subsect',
        'golongan',
        'acting',
        'timestamp',
    ];
}
