<?php


namespace App\Entities;


use App\Http\Resources\PostCollection;
use App\Post;
use App\Tag;
use App\User;
use App\Video;
use Illuminate\Support\Collection;
use Jackdaw\Contracts\AbstractEntity;
use Jackdaw\Contracts\EntityContract;
use Jackdaw\Contracts\EntityShowMode;
use Jackdaw\Contracts\FieldContract;
use Jackdaw\Contracts\RequestManagerContract;
use Jackdaw\Contracts\ResponseManagerContract;
use Jackdaw\DashboardComponents\Card;
use Jackdaw\Fields\IdField;
use Jackdaw\Fields\RelationshipField;
use Jackdaw\Fields\SaveOrUpdateField;
use Jackdaw\Fields\TextField;
use Jackdaw\DashboardComponents\NavigationLink;
use Jackdaw\Fields\WysiwygField;

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
            ->add(new WysiwygField('content'))
            ->add(
                (new RelationshipField('user_id'))
                    ->setIsMany(false)
                    ->setRelatedModel(User::class)
                    ->setModelField('user')
                    ->setDisplayField('emailAndUsername')
            )
            ->add(
                (new RelationshipField('video_id'))
                    ->setIsMany(false)
                    ->setRelatedModel(Video::class)
                    ->setModelField('video')
                    ->setDisplayField('title')
            )
            ->add(
                (new RelationshipField('tags'))
                    ->setIsMany(true)
                    ->setRelatedModel(Tag::class)
                    ->setModelField('tags')
                    ->setDisplayField('text')
            )
            ->add(
                (new RelationshipField('videos'))
                    ->setIsMany(true)
                    ->setRelatedModel(Video::class)
                    ->setModelField('videos')
                    ->setDisplayField('title')
            )
            ->add(new SaveOrUpdateField('save'))
        ;
    }

    public function getEditableFields(): array
    {
        return [
            'title', 'user_id', 'video_id', 'tags', 'videos'
        ];
    }

    public function getEditorLayout(): array
    {
        return [
            'content' => [
                [
                    'title' => 'Content',
                    'fields' => [ 'content' ]
                ]
            ],
            'sidebar' => [
                [
                    'title' => 'Basic information',
                    'fields' => [ 'title', 'user_id', 'video_id' ]
                ],
                [
                    'title' => 'Many related objects',
                    'fields' => [ 'tags', 'videos' ]
                ],
                [
                    'title' => null,
                    'fields' => [ 'save' ]
                ]
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

    public function getApiResource(): ?string
    {
        return \App\Http\Resources\Post::class;
    }

    public function getApiCollectionResource(): ?string
    {
        return PostCollection::class;
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

        \Route::get('/{post}/statistics', function (RequestManagerContract $requestManager, ResponseManagerContract $responseManager) {
            $this->buildMenu();

            $post = $requestManager->getPrimaryObject();

            $view = view('dashboard.page.posts.statistics')
                ->with('page', 'statistics')
                ->with('post', $post);

            return $responseManager->wrapResponse($view);
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
