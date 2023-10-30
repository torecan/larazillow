<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Facades\Auth;

class Offer extends Model
{
    use HasFactory;

    protected $fillable = ['amount', 'rejected_at', 'accepted_at'];
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

    public function scopeByMe(Builder $query) :Builder {

        return $query->where(
            "bidder_id", Auth::user()?->id
        );

    }


    public function scopeExcept(Builder $query, Offer $offer): Builder
    {
        return $query->where('id', '!=', $offer->id);
    }

}
