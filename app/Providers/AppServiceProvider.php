<?php

namespace App\Providers;

use App\Entities\PostEntity;
use App\Entities\TagEntity;
use App\Entities\VideoEntity;
use Illuminate\Support\Collection;
use Illuminate\Support\ServiceProvider;
use Jackdaw\Contracts\DashboardContract;
use Jackdaw\Contracts\EntityContract;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     * @throws \Illuminate\Contracts\Container\BindingResolutionException
     */
    public function register()
    {
        /** @var DashboardContract $dashboard */
        $dashboard = $this->app->make(DashboardContract::class);
        $dashboard
            ->addEntity(new PostEntity())
            ->addEntity(new VideoEntity())
            ->setSidebarBuilder(function (Collection $entities) {
                return $entities->groupBy(function (EntityContract $entityContract) {
                    return $entityContract->getSidebarSectionName();
                });
            })
            ->done();
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
