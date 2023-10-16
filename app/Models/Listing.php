<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletes;

class Listing extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
      'beds', 'baths', 'price', 'area', 'street', 'code','street_nr', 'city'
    ];

    protected $sortable = [
        'price', 'created_at'
    ];

    public function owner() :BelongsTo {

        return $this->belongsTo(
          \App\Models\User::class,
          "by_user_id"
        );
    }

    public function images(): HasMany {
        return $this->hasMany(\App\Models\ListingImage::class);
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
        )
        ->when(
            $filters['deleted'] ?? false,
            fn ($query) => $query->withTrashed()
        )
        ->when(
            $filters['by'] ?? false,
            fn($query, $value) =>
                !in_array($filters['by'], $this->sortable) ?
                    $query :
                    $query->orderBy($value, $filters['order'] ?? 'desc')
        );
    }
}
