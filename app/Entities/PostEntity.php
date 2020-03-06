<?php


namespace App\Entities;


use App\Post;
use Illuminate\Support\Collection;
use Jackdaw\Contracts\AbstractEntity;
use Jackdaw\Contracts\EntityContract;
use Jackdaw\Contracts\FieldContract;
use Jackdaw\DashboardComponents\Card;
use Jackdaw\Fields\TextField;
use Jackdaw\DashboardComponents\NavigationLink;

class PostEntity extends AbstractEntity
{

    public function config()
    {
        /// todo: additional entity configuration
    }

    /**
     * @inheritDoc
     */
    public function getFields(): Collection
    {
        return collect([])
            ->add(new TextField("id"))
            ->add(new TextField("title"));
    }

    public function getEditableFields(): array
    {
        return [ 'title' ];
    }

    public function getTableFields(): array
    {
        return [ 'id', 'title' ];
    }

    public function getTranslations(): array
    {
        return trans('dashboard.posts');
    }

    public function getModel()
    {
        return Post::class;
    }

    public function getSidebarSectionName(): string
    {
        return 'entities';
    }

    public function getApiConfig(): array
    {
        return [
            'api' => true,
            'apiMethods' => [ 'index', 'show' ],
            'rootModel' => null
        ];
    }

    public function getChildEntities(): array
    {
        return [
            [
                'entity' => TagEntity::class,
                'api' => true,
                'apiMethods' => [ 'index' ],
                'rootModel' => $this->getModel()
            ]
        ];
    }

    public function getCards(): array
    {
        return [
            (new Card())
                ->setCounter(100)
                ->setHeader('All Posts')
                ->setSubheader('Number of all created posts')
        ];
    }

    public function bindAdditionalRoutes()
    {
        \Route::get('hello-world', function () {
            return view('dashboard.hello-world')
                ->with('entity', $this);
        })->name('hello-world');

        \Route::get('settings', function () {
            return view('dashboard.settings')
                ->with('entity', $this);
        })->name('settings');
    }

    public function bindAdditionalApiRoutes()
    {
        \Route::get('hello-world', function () {
            return [ 'posts' => 100 ];
        });
    }

    public function getNavigation(): array
    {
        $currentPage = request()->route()->getName();

        return [
            (new NavigationLink())
                ->setBadge(0)
                ->setTitle('hello world')
                ->setUrl(route('dashboard.posts.hello-world'))
                ->setIsActive($currentPage === 'dashboard.posts.hello-world')
                ->setPosition('tabs'),
            (new NavigationLink())
                ->setBadge(0)
                ->setTitle('Settings')
                ->setUrl(route('dashboard.posts.settings'))
                ->setIsActive($currentPage === 'dashboard.posts.settings')
                ->setPosition('tabs')
        ];
    }

}
