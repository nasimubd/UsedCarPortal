<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Car extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'user_id',
        'make',
        'model',
        'registration_year',
        'price',
        'registration_number',
        'description',
        'image_path',
        'is_active',
    ];

    /**
     * Get the user that owns the car.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Scope a query to filter by make.
     */
    public function scopeFilterMake($query, $make)
    {
        return $query->where('make', 'like', '%' . $make . '%');
    }

    /**
     * Scope a query to filter by model.
     */
    public function scopeFilterModel($query, $model)
    {
        return $query->where('model', 'like', '%' . $model . '%');
    }

    /**
     * Scope a query to filter by registration year.
     */
    public function scopeFilterRegistrationYear($query, $year)
    {
        return $query->where('registration_year', $year);
    }

    /**
     * Scope a query to filter by minimum price.
     */
    public function scopeFilterPriceMin($query, $min)
    {
        return $query->where('price', '>=', $min);
    }

    /**
     * Scope a query to filter by maximum price.
     */
    public function scopeFilterPriceMax($query, $max)
    {
        return $query->where('price', '<=', $max);
    }

    public function transaction()
    {
        return $this->hasOne(Transaction::class);
    }

    /**
     * Get the appointments booked by the user.
     */
    public function appointments()
    {
        return $this->hasMany(Appointment::class);
    }

    /**
     * Get the bids for the car.
     */
    public function bids()
    {
        return $this->hasMany(Bid::class);
    }

    /**
     * Get the highest bid for the car.
     */
    public function highestBid()
    {
        return $this->hasOne(Bid::class)->orderBy('amount', 'desc');
    }

    public function images()
    {
        return $this->hasMany(CarImage::class);
    }

    public function primaryImage()
    {
        return $this->hasOne(CarImage::class)->where('is_primary', true);
    }
}
