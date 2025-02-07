<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Asset extends Model
{
    //
    protected $table = 'assets';
    protected $primaryKey = 'asset_id';

    protected $fillable = [
        'name',
        'description',
        'details',
        'status',
    ];
}
