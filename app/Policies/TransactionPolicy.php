<?php

namespace App\Policies;

use App\Models\Transaction;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class TransactionPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any transactions.
     *
     * @param  \App\Models\User  $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        return $user->isAdmin();
    }

    /**
     * Determine whether the user can view the transaction.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Transaction  $transaction
     * @return mixed
     */
    public function view(User $user, Transaction $transaction)
    {
        return $user->isAdmin();
    }

    /**
     * Determine whether the user can create transactions.
     *
     * @param  \App\Models\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return false; // Transactions are created automatically when a bid is placed
    }

    /**
     * Determine whether the user can update the transaction.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Transaction  $transaction
     * @return mixed
     */
    public function update(User $user, Transaction $transaction)
    {
        return $user->isAdmin();
    }

    /**
     * Determine whether the user can delete the transaction.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Transaction  $transaction
     * @return mixed
     */
    public function delete(User $user, Transaction $transaction)
    {
        return $user->isAdmin();
    }

    /**
     * Determine whether the user can sell the transaction.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Transaction  $transaction
     * @return mixed
     */
    public function sell(User $user, Transaction $transaction)
    {
        return $user->isAdmin() && $transaction->status === 'pending';
    }

    /**
     * Determine whether the user can deny the transaction.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Transaction  $transaction
     * @return mixed
     */
    public function deny(User $user, Transaction $transaction)
    {
        return $user->isAdmin() && $transaction->status === 'pending';
    }
}
