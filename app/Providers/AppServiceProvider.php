<?php

namespace App\Providers;

use App\Models\Representative;
use App\Models\Student;
use App\Models\User;
use App\Policies\Apoderado\RepresentativePolicy;
use App\Policies\Deportista\StudentPolicy;
use App\Policies\UserPolicy;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Gate::guessPolicyNamesUsing(function (string $modelClass) {
            return str_replace('Models', 'Policies', $modelClass) . 'Policy';
        });
        Gate::policy(User::class, UserPolicy::class);
        Gate::policy(Student::class, StudentPolicy::class);
        Gate::policy(Representative::class, RepresentativePolicy::class);
    }
}
