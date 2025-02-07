<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Asset extends Model
{
    //
    protected $table = 'assets';
    protected $fillable = [
        'name',
        'description',
        'details',
        'status',
    ];

    public function loans()
    {
        return $this->hasMany(AssetLoan::class, 'asset_id', 'id');
    }
}
