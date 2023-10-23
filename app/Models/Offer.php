<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Offer extends Model
{
    use HasFactory;

    protected $fillable = ['amount'];
    public function bidder() : BelongsTo {

        return $this->belongsTo(
           User::class,
        );
    }

    public function listing(): BelongsTo {
        return $this->belongsTo(
            Listing::class,
            'by_listing_id'
        );
    }

}
