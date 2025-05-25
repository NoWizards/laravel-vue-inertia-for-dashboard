<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ListingImage extends Model
{
    //
    use HasFactory;
    protected $appends = ['src'];

    protected $fillable = ['filename'];

    public function listing(): BelongsTo
    {
        return $this->belongsTo(Listing::class);
    }
    // getRealSrcAttribute -> real_src
    public function getSrcAttribute()
    {
        return asset("storage/{$this->filename}");
    }
}
