<?php

namespace App\Policies;

use App\Models\Bid;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class BidPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any bids.
     *
     * @param  \App\Models\User  $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        return $user->isAdmin();
    }

    /**
     * Determine whether the user can view the bid.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Bid  $bid
     * @return mixed
     */
    public function view(User $user, Bid $bid)
    {
        return $user->id === $bid->user_id || $user->isAdmin();
    }

    /**
     * Determine whether the user can create bids.
     *
     * @param  \App\Models\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return $user->isUser();
    }

    /**
     * Determine whether the user can update the bid.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Bid  $bid
     * @return mixed
     */
    public function update(User $user, Bid $bid)
    {
        return $user->id === $bid->user_id || $user->isAdmin();
    }

    /**
     * Determine whether the user can delete the bid.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Bid  $bid
     * @return mixed
     */
    public function delete(User $user, Bid $bid)
    {
        return $user->id === $bid->user_id || $user->isAdmin();
    }
}
