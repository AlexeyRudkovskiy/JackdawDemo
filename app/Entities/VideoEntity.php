<?php


namespace App\Entities;


use App\Video;
use Illuminate\Support\Collection;
use Jackdaw\Contracts\AbstractEntity;
use Jackdaw\Fields\TextField;

class VideoEntity extends AbstractEntity
{

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

    public function getApiConfig(): array
    {
        return [
            'api' => false,
            'apiMethods' => []
        ];
    }
}
