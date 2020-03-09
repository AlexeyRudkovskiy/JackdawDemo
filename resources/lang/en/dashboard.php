<?php

return [

    'general' => [
        'sidebar' => [
            'section' => [
                'entities' => 'Entities'
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
                'title' => 'Title'
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
