<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletes;

class Listing extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
      'beds', 'baths', 'price', 'area', 'street', 'code','street_nr', 'city'
    ];

    public function owner() :BelongsTo {

        return $this->belongsTo(
          \App\Models\User::class,
          "by_user_id"
        );
    }

    public function scopeMostRecent($query) {
        return $query->orderByDesc('created_at');
    }

    public function scopeFilters(Builder $query, array $filters) :Builder {

        return $query->when(
            $filters['priceFrom'] ?? false,
            fn($query, $value) => $query->where('price', '>=', $value)
        )
        ->when(
            $filters['priceTo'] ?? false,
            fn($query, $value) => $query->where('price', '<=', $value)
        )
        ->when(
            $filters['beds'] ?? false,
            fn($query, $value) => $query->where('beds', '>=', $value)
        )
        ->when(
            $filters['baths'] ?? false,
            fn($query, $value) => $query->where('baths', '<=', $value)
        )

        ->when(
            $filters['areaFrom'] ?? false,
            fn($query, $value) => $query->where('area', '>=', $value)
        )
        ->when(
            $filters['areaTo'] ?? false,
            fn($query, $value) => $query->where('area', '<=', $value)
        );

    }

}
