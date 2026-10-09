<?php

namespace App\Providers;

use Illuminate\Support\Facades\URL;
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
        $appUrl = $this->codespacesAppUrl();
        if ($appUrl !== null) {
            URL::forceRootUrl($appUrl);
            URL::forceScheme('https');
        }
    }

    private function codespacesAppUrl(): ?string
    {
        if (! filter_var(getenv('CODESPACES'), FILTER_VALIDATE_BOOL)) {
            return null;
        }

        $name = getenv('CODESPACE_NAME');
        if ($name === false || $name === '') {
            return null;
        }

        $domain = getenv('GITHUB_CODESPACES_PORT_FORWARDING_DOMAIN');
        if ($domain === false || $domain === '') {
            $domain = 'app.github.dev';
        }

        return "https://{$name}-8000.{$domain}";
    }
}
