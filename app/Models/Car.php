<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Car extends Model
{
    use HasFactory;
    protected $fillable = [
      'serial_no',
      'plate_no',
      'color',
      'owner_name',
      'brand_id',
    ];

    public function brand(): BelongsTo
    {
        return $this->belongsTo(Brand::class,'brand_id','id');
    }
}
