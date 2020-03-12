<?php


namespace App\Entities;


use App\Video;
use Illuminate\Support\Collection;
use Jackdaw\Contracts\AbstractEntity;
use Jackdaw\Contracts\EntityShowMode;
use Jackdaw\DashboardComponents\NavigationLink;
use Jackdaw\Fields\IdField;
use Jackdaw\Fields\TextField;

class VideoEntity extends AbstractEntity
{

    /**
     * @inheritDoc
     */
    public function getFields(): Collection
    {
        return collect([])
            ->add(new IdField("id"))
            ->add(new TextField("title"));
    }

    public function getEditableFields(): array
    {
        return [ 'title' ];
    }

    public function getEditorLayout(): array
    {
        return [ 'title' ];
    }

    public function getTableFields(): array
    {
        return [ 'id', 'title' ];
    }

    public function getShowMode(): string
    {
        return EntityShowMode::DETAILS;
    }

    public function getTranslations(): array
    {
        return trans('dashboard.videos');
    }

    public function getModel()
    {
        return Video::class;
    }

    public function getSidebarSectionName(): string
    {
        return 'entities';
    }

    public function getNavigation($recordId): array
    {
        return [
            (new NavigationLink())
                ->setBadge(0)
                ->setIsActive(false)
                ->setPosition('tabs')
                ->setTitle('All Videos')
                ->setUrl('/'),
            (new NavigationLink())
                ->setBadge(0)
                ->setIsActive(true)
                ->setPosition('tabs')
                ->setTitle('Popular')
                ->setUrl('/'),
            (new NavigationLink())
                ->setBadge(0)
                ->setIsActive(false)
                ->setPosition('tabs')
                ->setTitle('Newest')
                ->setUrl('/')
        ];
    }

    public function getApiConfig(): array
    {
        return [
            'api' => true,
            'apiMethods' => [ 'index', 'show' ]
        ];
    }
}
