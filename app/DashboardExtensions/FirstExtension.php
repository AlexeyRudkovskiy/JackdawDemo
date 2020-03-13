<?php


namespace App\DashboardExtensions;


use Jackdaw\Contracts\DashboardContract;
use Jackdaw\Contracts\ExtensionContract;
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

    public function register(DashboardContract $dashboard)
    {

    }

}
