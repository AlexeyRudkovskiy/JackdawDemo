<?php


namespace App\Entities;


use App\Post;
use Illuminate\Support\Collection;
use Jackdaw\Contracts\EntityContract;
use Jackdaw\Contracts\FieldContract;
use Jackdaw\Fields\TextField;

class PostEntity implements EntityContract
{

    /**
     * @return Collection<FieldContract>
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
        return [];
    }

    public function getShortName()
    {
        return 'post';
    }

    public function getModel()
    {
        return Post::class;
    }

    public function getSidebarSectionName(): string
    {
        return 'posts';
    }

}
