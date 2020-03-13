<?php

namespace App\Providers;

use App\DashboardExtensions\FirstExtension\FirstExtension;
use App\Entities\PostEntity;
use App\Entities\TagEntity;
use App\Entities\VideoEntity;
use Illuminate\Support\Collection;
use Illuminate\Support\ServiceProvider;
use Jackdaw\Contracts\DashboardContract;
use Jackdaw\Contracts\EntityContract;
use Jackdaw\Contracts\ExtensionsManagerContract;
use Jackdaw\Contracts\NavigationLinkContract;
use Jackdaw\DashboardComponents\NavigationLink;

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
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        /** @var DashboardContract $dashboard */
        $dashboard = $this->app->make(DashboardContract::class);
        $extensionsManager = $this->app->make(ExtensionsManagerContract::class);

        $extensionsManager->registerExtension(new FirstExtension());

        $dashboard
            ->addEntity(new PostEntity())
            ->addEntity(new VideoEntity())
            ->setSidebarBuilder(function (Collection $entities, Collection $additionalLinks) use ($dashboard) {
                return $entities
                    ->map(function (EntityContract $entity) use ($dashboard) {
                        return $dashboard->createLinkForEntity($entity);
                    })
                    ->merge($additionalLinks)
                    ->sortBy(function (NavigationLinkContract $link) {
                        return $link->getOrderIndex();
                    })
                    ->groupBy(function (NavigationLinkContract $link) {
                        return $link->getSection();
                    });
            })
            ->done();
    }
}
