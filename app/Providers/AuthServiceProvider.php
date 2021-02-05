<?php

namespace App\Providers;

use Carbon\Carbon;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;
use Laravel\Passport\Passport;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        // 'App\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        Passport::routes();
        Passport::tokensExpireIn(Carbon::now()->addhours(1));
        Passport::refreshTokensExpireIn(Carbon::now()->addDays(15));
        Passport::enableImplicitGrant();

        Passport::tokensCan([
            'purchase-product' => 'Create a transaction for specific product',
            'manage-products' => 'Create, Read, Update, and Delete the products (CRUD)',
            'manage-account' => 'Read your account data id, name, email, isAdmin (cannot read password), isVerified (cannot delete user)',
            'read-general' => 'Read general informations like purchasing categories, purchased products, selling products, selling categories, your transactions (purchases and sales)',
        ]);
    }
}
