<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Database\Eloquent\Relations\MorphToMany;

class Vehicle extends Model
{
    use HasFactory;

    protected $fillable = [
        'category_id',
        'name',
        'brand',
        'model',
        'year',
        'price',
        'stock',
        'description',
        'specifications',
        'images',
        'condition',
        'is_featured',
        'views_count',
    ];

    protected $casts = [
        'specifications' => 'array',
        'images' => 'array',
        'price' => 'decimal:2',
        'is_featured' => 'boolean',
        'views_count' => 'integer',
    ];

    /**
     * Get the category of the vehicle
     */
    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    /**
     * Get all order items for this vehicle
     */
    public function orderItems(): MorphMany
    {
        return $this->morphMany(OrderItem::class, 'orderable');
    }

    /**
     * Get all reviews for this vehicle
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

    /**
     * Increment views count
     */
    public function incrementViews(): void
    {
        $this->increment('views_count');
    }
}
