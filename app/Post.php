<?php

namespace App;

use App\Entities\TagEntity;
use App\Entities\VideoEntity;
use Illuminate\Database\Eloquent\Model;
use Jackdaw\Entities\EntityModel;

class Post extends Model
{

    use EntityModel;

    protected $fillable = [
        'title', 'user_id', 'video_id', 'content'
    ];

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

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function video()
    {
        return $this->belongsTo(Video::class);
    }

}
