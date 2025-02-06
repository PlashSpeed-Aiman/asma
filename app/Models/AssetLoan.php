<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


/**
 * @property int $id
 * @property int $asset_id
 * @property string $name
 * @property string $telephone_number
 * @property \DateTime $start_date
 * @property \DateTime $end_date
 * @property string $status
 * @property \DateTime $created_at
 * @property \DateTime $updated_at
 */
class AssetLoan extends Model
{
    protected $table = 'asset_loans';
    protected $fillable = ['asset_id', 'name', 'telephone_number', 'start_date','end_date', 'status'];

    public function asset(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
            return $this->belongsTo(Asset::class);
    }

}
