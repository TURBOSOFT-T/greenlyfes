<?php

namespace App\Providers;
;

use App\Models\Post;
use App\Policies\PostPolicy;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;
use Laravel\Passport\Passport;
use Carbon\Carbon;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        'App\Model' => 'App\Policies\ModelPolicy',
       // Post::class => PostPolicy::class,
    ];

  
    

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

       // Passport::routes();
    //    Passport::routes();
      //  Passport::enableImplicitGrant();
      //  Passport::tokensExpireIn(Carbon::now()->addDays(1));
      //  Passport::refreshTokensExpireIn(Carbon::now()->addDays(10));
    }
}