<?php


namespace App\DashboardExtensions;


use App\Entities\PostEntity;
use Jackdaw\Contracts\DashboardContract;
use Jackdaw\Contracts\ExtensionContract;
use Jackdaw\Contracts\ExtensionsManagerContract;
use Jackdaw\Contracts\RequestManagerContract;
use Jackdaw\DashboardComponents\NavigationLink;

class FirstExtension implements ExtensionContract
{

    public function bindRoutes()
    {
        \Route::get('settings', function () {
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

    public function register(ExtensionsManagerContract $extensionsMangaer)
    {

    }

    public function getTargets(): array
    {
        return [
            PostEntity::class
        ];
    }

}
