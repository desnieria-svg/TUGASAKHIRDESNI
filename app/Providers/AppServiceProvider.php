<?php

namespace App\Providers;

use Illuminate\Support\Facades\URL;

public function boot(): void
{
    if (config('app.env') === 'production') {
        URL::forceScheme('https');
    }
}
{
    public function boot(): void
    {
        //
    }
}
