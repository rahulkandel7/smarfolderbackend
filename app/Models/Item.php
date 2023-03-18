<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    use HasFactory;

    protected $fillable = [
        'asset_id',
        'photopath',
    ];

    public function asset()
    {
        return $this->belongsTo(Asset::class);
    }
}
