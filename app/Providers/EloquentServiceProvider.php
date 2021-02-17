<?php

namespace App\Providers;

use App\Repositories\Contracts\IKnowledgeRepository;
use App\Repositories\Contracts\IUrlRepository;
use App\Repositories\Contracts\IVideoRepository;
use App\Repositories\KnowledgeRepository;
use App\Repositories\UrlRepository;
use App\Repositories\VideoRepository;
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
        $this->app->bind(IVideoRepository::class, VideoRepository::class);
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
