<?php


namespace App\Entities;


use App\Tag;
use Illuminate\Support\Collection;
use Jackdaw\Contracts\AbstractEntity;
use Jackdaw\Contracts\EntityContract;
use Jackdaw\Fields\TextField;

class TagEntity extends AbstractEntity
{

    /**
     * @inheritDoc
     */
    public function getFields(): Collection
    {
        return collect([])
            ->push(new TextField("id"))
            ->push(new TextField("text"))
            ->push(new TextField("slug"))
            ;
    }

    public function getEditableFields(): array
    {
        return [
            'text'
        ];
    }

    public function getTableFields(): array
    {
        return [ 'id', 'text', 'slug' ];
    }

    public function getTranslations(): array
    {
        return [];
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
