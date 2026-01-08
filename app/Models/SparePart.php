<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphMany;

class SparePart extends Model
{
    use HasFactory;

    protected $fillable = [
        'category_id',
        'name',
        'part_number',
        'brand',
        'price',
        'stock',
        'description',
        'compatible_vehicles',
        'image',
        'is_available',
    ];

    protected $casts = [
        'compatible_vehicles' => 'array',
        'price' => 'decimal:2',
        'is_available' => 'boolean',
    ];

    /**
     * Get the category of the spare part
     */
    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    /**
     * Get all order items for this spare part
     */
    public function orderItems(): MorphMany
    {
        return $this->morphMany(OrderItem::class, 'orderable');
    }

    /**
     * Get all reviews for this spare part
     */
    public function reviews(): MorphMany
    {
        return $this->morphMany(Review::class, 'reviewable');
    }

    /**
     * Get average rating
     */
    public function averageRating(): float
    {
        return $this->reviews()->avg('rating') ?? 0;
    }
}
