<?php

namespace App;

use App\Entities\TagEntity;
use App\Entities\VideoEntity;
use Illuminate\Database\Eloquent\Model;
use Jackdaw\Entities\EntityModel;

class Post extends Model
{

    use EntityModel;

    protected $childMaps = [
        TagEntity::class => 'tags',
        VideoEntity::class => 'videos'
    ];

    public function tags()
    {
        return $this->belongsToMany(Tag::class);
    }

    public function videos()
    {
        return $this->belongsToMany(Video::class);
    }

}
