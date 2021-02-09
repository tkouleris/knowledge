<?php

namespace App\Providers;

use App\Repositories\Contracts\IKnowledgeRepository;
use App\Repositories\Contracts\IUrlRepository;
use App\Repositories\KnowledgeRepository;
use App\Repositories\UrlRepository;
use Illuminate\Support\ServiceProvider;

class EloquentServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(IKnowledgeRepository::class, KnowledgeRepository::class);
        $this->app->bind(IUrlRepository::class, UrlRepository::class);
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
