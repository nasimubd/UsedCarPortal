<?php

namespace App\Policies;

use App\Models\Invoice;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class InvoicePolicy
{
    use HandlesAuthorization;

    public function viewAny(User $user)
    {
        return $user->isAdmin();
    }

    public function view(User $user, Invoice $invoice)
    {
        return $user->isAdmin() || $user->id === $invoice->user_id;
    }

    public function resend(User $user, Invoice $invoice)
    {
        return $user->isAdmin();
    }
}
