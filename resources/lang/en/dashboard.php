<?php

return [

    'general' => [
        'sidebar' => [
            'section' => [
                'entities' => 'Entities',
                'other' => 'Other'
            ]
        ],
    ],

    'posts' => [
        'tabs' => [
            'root' => 'Post',
            'index' => 'All Posts'
        ],
        'sidebar' => [
            'label' => 'Posts'
        ],
        'table' => [
            'field' => [
                'id' => 'ID',
                'title' => 'Title'
            ]
        ],
        'edit' => [
            'field' => [
                'title' => 'Title',
                'user_id' => 'Author',
                'video_id' => 'Video',
                'tags' => 'Tags',
                'videos' => 'Videos'
            ]
        ]
    ],

    'videos' => [
        'sidebar' => [
            'label' => 'Videos'
        ],
        'table' => [
            'field' => [
                'id' => 'ID',
                'title' => 'Title'
            ],
        ],
    ],

    'tags' => [
        'table' => [
            'field' => [
                'id' => 'ID',
                'text' => 'Text',
                'slug' => 'Slug'
            ]
        ],
        'edit' => [
            'field' => [
                'text' => 'Text',
                'slug' => 'Slug'
            ]
        ]
    ],

];
