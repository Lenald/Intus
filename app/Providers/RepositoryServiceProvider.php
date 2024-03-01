<?php

namespace App\Providers;

use App\Models\Link;
use App\Models\LinkInterface;
use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->bind(LinkInterface::class, Link::class);
    }

    public function boot(): void
    {
    }
}
