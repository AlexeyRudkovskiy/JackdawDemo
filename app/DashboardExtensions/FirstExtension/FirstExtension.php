<?php


namespace App\DashboardExtensions\FirstExtension;


use App\Entities\PostEntity;
use App\Entities\VideoEntity;
use App\Post;
use Jackdaw\Contracts\DashboardContract;
use Jackdaw\Contracts\ExtensionContract;
use Jackdaw\Contracts\ExtensionsManagerContract;
use Jackdaw\Contracts\RequestManagerContract;
use Jackdaw\DashboardComponents\NavigationLink;

class FirstExtension implements ExtensionContract
{

    public function bindRoutes()
    {
        \Route::get('/post/', function ($test) {
            return 'settings page!';
        })->name('first_extension.settings');
    }

    public function buildMenu(DashboardContract $dashboard)
    {
        $firstLink = (new NavigationLink())
            ->setSection('entities')
            ->setTitle('test 33')
            ->setUrl(route('first_extension.settings'))
            ->setAliases([]);

        $dashboard->addSidebarLink($firstLink);
    }

    public function register(ExtensionsManagerContract $extensionsManager)
    {
        $extensionsManager
            ->registerUiComponent(new SimpleUiComponent(), [ PostEntity::class, VideoEntity::class ], 'editor:content')
            ->registerUiComponent(new SecondUiComponent(), [ PostEntity::class ], 'editor:sidebar', 101)
        ;
    }

    public function getTargets(): array
    {
        return [
            PostEntity::class
        ];
    }

}
