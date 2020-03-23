<?php

namespace App\Providers;

use App\User;
use Illuminate\Support\Facades\Gate;
use App\Services\Auth\JwtGuard;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        'App\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        Auth::viaRequest('custom-token', function ($request) {
            if ($request->header('authorization') == null) {
                dd('токен не указан');
            }
            $token = explode(' ', $request->header('authorization'));
            if (User::where('api_token', $token[1])->first()) {
                return User::where('api_token', $token[1])->first();
            } else {
                dd('Неверный токен');
            }
        });
    }
}