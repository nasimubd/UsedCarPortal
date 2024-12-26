<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'bid_id',
        'admin_id',
        'status',
    ];

    /**
     * Get the bid associated with the transaction.
     */
    public function bid()
    {
        return $this->belongsTo(Bid::class);
    }

    /**
     * Get the admin who processed the transaction.
     */
    public function admin()
    {
        return $this->belongsTo(User::class, 'admin_id');
    }

    public function user()
    {
        return $this->hasOneThrough(
            User::class,   // Final model
            Bid::class,    // Intermediate model
            'id',          // Foreign key on bids table
            'id',          // Foreign key on users table
            'bid_id',      // Local key on transactions table
            'user_id'      // Local key on bids table
        );
    }
}
