<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;
use App\Models\Car;
use App\Policies\CarPolicy;
use App\Models\Bid;
use App\Policies\BidPolicy;
use App\Models\Transaction;
use App\Policies\TransactionPolicy;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        Car::class => CarPolicy::class,
        Bid::class => BidPolicy::class,
        Transaction::class => TransactionPolicy::class,
        // Other policies...
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        //
    }
}
