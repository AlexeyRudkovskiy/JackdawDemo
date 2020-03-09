<?php


namespace App\Entities;


use App\Tag;
use Illuminate\Support\Collection;
use Jackdaw\Contracts\AbstractEntity;
use Jackdaw\Contracts\EntityContract;
use Jackdaw\Contracts\EntityShowMode;
use Jackdaw\Fields\IdField;
use Jackdaw\Fields\SaveOrUpdateField;
use Jackdaw\Fields\TextField;

class TagEntity extends AbstractEntity
{

    /**
     * @inheritDoc
     */
    public function getFields(): Collection
    {
        return collect([])
            ->push(new IdField("id"))
            ->push(new TextField("text"))
            ->push(new TextField("slug"))
            ->push(new SaveOrUpdateField('save'))
        ;
    }

    public function getEditableFields(): array
    {
        return [
            'sidebar' => [
                [
                    'title' => 'test',
                    'fields' => [ 'text', 'slug', 'save' ]
                ]
            ],
            'content' => []
        ];
    }

    public function getTableFields(): array
    {
        return [ 'id', 'text', 'slug' ];
    }

    public function getShowMode(): string
    {
        return EntityShowMode::EDIT;
    }

    public function getTranslations(): array
    {
        return trans('dashboard.tags');
    }

    public function getShortName()
    {
        return 'tag';
    }

    public function getModel()
    {
        return Tag::class;
    }

    public function getSidebarSectionName(): string
    {
        return 'posts';
    }
}
