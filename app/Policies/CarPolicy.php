<?php

namespace App\Policies;

use App\Models\Car;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class CarPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can update the car.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Car  $car
     * @return mixed
     */
    public function update(User $user, Car $car)
    {
        return $user->id === $car->user_id || $user->role === 'admin';
    }

    /**
     * Determine whether the user can delete the car.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Car  $car
     * @return mixed
     */
    public function delete(User $user, Car $car)
    {
        return $user->id === $car->user_id || $user->isAdmin();
    }

    public function viewInIndex(User $user = null, Car $car = null)
    {
        // If no user is logged in
        if (!$user) {
            return $car->is_active;
        }

        // Admin can see everything
        if ($user->isAdmin()) {
            return true;
        }

        // User can see their own cars and active cars
        return $car->is_active || $car->user_id === $user->id;
    }
}
