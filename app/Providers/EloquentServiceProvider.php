<?php

namespace App\Providers;

use App\Repositories\Contracts\IKnowledgeRepository;
use App\Repositories\KnowledgeRepository;
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
