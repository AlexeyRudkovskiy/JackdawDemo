<?php


namespace App\Entities;


use App\Post;
use Illuminate\Support\Collection;
use Jackdaw\Contracts\AbstractEntity;
use Jackdaw\Contracts\EntityContract;
use Jackdaw\Contracts\EntityShowMode;
use Jackdaw\Contracts\FieldContract;
use Jackdaw\DashboardComponents\Card;
use Jackdaw\Fields\IdField;
use Jackdaw\Fields\SaveOrUpdateField;
use Jackdaw\Fields\TextField;
use Jackdaw\DashboardComponents\NavigationLink;

class PostEntity extends AbstractEntity
{

    public function config()
    {

    }

    /**
     * @inheritDoc
     */
    public function getFields(): Collection
    {
        return collect([])
            ->add(new IdField("id"))
            ->add(new TextField("title"))
            ->add(new SaveOrUpdateField('save'))
        ;
    }

    public function getEditableFields(): array
    {
        return [
            'content' => [
                [
                    'title' => 'Content',
                    'fields' => [ 'title' ]
                ]
            ],
            'sidebar' => [
                [
                    'title' => 'Basic information',
                    'fields' => [ 'title', 'save' ]
                ],
            ]
        ];
    }

    public function getTableFields(): array
    {
        return [ 'id', 'title' ];
    }

    public function getShowMode(): string
    {
        return EntityShowMode::EDIT;
    }

    public function getValidation(): array
    {
        return [
            'title' => 'required'
        ];
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
            ], [
                'entity' => VideoEntity::class,
                'api' => true,
                'apiMethods' => [ 'index' ],
                'rootModel' => $this->getModel()
            ]
        ];
    }

    public function getCards(string $position): array
    {
        if ($position === 'index') {
            return [
                (new Card())
                    ->setCounter(100)
                    ->setHeader('All Posts')
                    ->setSubheader('Number of all created posts')
                    ->setPosition('index')
            ];
        } else if ($position === 'show') {
            return [];
        }

        return [];
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

        \Route::get('/{post}/statistics', function (int $postId) {
            $this->buildTabs();

            $post = Post::findOrFail($postId);

            return view('dashboard.page.posts.statistics')
                    ->with('entity', $this)
                    ->with('rootEntity', $this)
                    ->with('rootObject', $post)
                    ->with('object', $post)
                    ->with('post', $post)
                    ->with('page', 'statistics')
                ;
        })->name('statistics');
    }

    public function getNavigation($recordId): array
    {
        $currentPage = request()->route()->getName();

        return [
            (new NavigationLink())
                ->setBadge(0)
                ->setTitle('Statistics')
                ->setUrl(route('dashboard.posts.statistics', [ 'post' => 1 ]))
                ->setIsActive($currentPage === 'dashboard.posts.statistics')
                ->setPosition('tabs.show'),
        ];
    }

}
