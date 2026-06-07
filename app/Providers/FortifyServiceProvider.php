<?php

namespace App\Providers;

use App\Actions\Fortify\CreateNewUser;
use App\Actions\Fortify\ResetUserPassword;
use App\Actions\Fortify\UpdateUserPassword;
use App\Actions\Fortify\UpdateUserProfileInformation;
use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Str;
use Laravel\Fortify\Fortify;

class FortifyServiceProvider extends ServiceProvider
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
        Fortify::createUsersUsing(CreateNewUser::class);
        Fortify::updateUserProfileInformationUsing(UpdateUserProfileInformation::class);
        Fortify::updateUserPasswordsUsing(UpdateUserPassword::class);
        Fortify::resetUserPasswordsUsing(ResetUserPassword::class);
        Fortify::loginView(function (Request $request) {
            $this->storeLoginRedirect($request);

            return view('auth.login');
        });

        // Uncomment the following lines when you want to enable email verification
        /*
        // Register the email verification view
        Fortify::verifyEmailView(function () {
            return view('auth.verify-email');
        });
        */

        RateLimiter::for('login', function (Request $request) {
            $throttleKey = Str::transliterate(Str::lower($request->input(Fortify::username())).'|'.$request->ip());

            return Limit::perMinute(5)->by($throttleKey);
        });

        RateLimiter::for('two-factor', function (Request $request) {
            return Limit::perMinute(5)->by($request->session()->get('login.id'));
        });
    }

    private function storeLoginRedirect(Request $request): void
    {
        if ($request->session()->has('url.intended')) {
            return;
        }

        $previousUrl = url()->previous();

        if ($this->isSafeLoginRedirect($request, $previousUrl)) {
            $request->session()->put('url.intended', $previousUrl);
        }
    }

    private function isSafeLoginRedirect(Request $request, ?string $url): bool
    {
        if (!$url || $url === $request->fullUrl()) {
            return false;
        }

        $host = parse_url($url, PHP_URL_HOST);
        if ($host && $host !== $request->getHost()) {
            return false;
        }

        $path = '/' . ltrim(parse_url($url, PHP_URL_PATH) ?: '/', '/');
        $authPaths = [
            '/login',
            '/register',
            '/forgot-password',
            '/reset-password',
            '/two-factor-challenge',
            '/logout',
        ];

        if (in_array($path, $authPaths, true) || str_starts_with($path, '/reset-password/')) {
            return false;
        }

        return true;
    }
}
