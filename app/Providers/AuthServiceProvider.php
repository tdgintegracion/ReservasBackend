<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;
use Laravel\Passport\Passport;
use Carbon\Carbon;


class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        // 'App\Models\Model' => 'App\Policies\ModelPolicy',
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
        Passport::tokensExpireIn(Carbon::now()->addHours(2));
        Passport::refreshTokensExpireIn(Carbon::now()->addHours(2));
        Passport::personalAccessTokensExpireIn(Carbon::now()->addHours(2));
        Passport::tokensCan([
            'Admin' => 'Add/Edit/Delete/List',
            'Externo' => 'Add/Edit',
            'Alumno' => 'Add/Edit',
            'Profesor' => 'Add/Edit'
        ]);
    }
}