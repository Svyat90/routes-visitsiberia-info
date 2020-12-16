<?php

return [
    'base' => [
        'fields'         => [
            'id'                => 'ID',
            'created_at'        => 'Created at',
            'updated_at'        => 'Updated at',
            'deleted_at'        => 'Deleted at',
        ]
    ],
    'user'                         => [
        'title'          => 'Users',
        'title_singular' => 'User',
        'fields'         => [
            'name'                         => 'Name',
            'name_helper'                  => '',
            'email'                        => 'Email',
            'email_helper'                 => '',
            'password'                     => 'Password',
            'password_helper'              => '',
        ],
    ],
    'dictionaries'                     => [
        'title'          => 'Dictionaries',
        'title_singular' => 'Dictionary',
        'fields'         => [
            'name'              => 'Name',
            'name_helper'       => '',
            'name_ru'              => 'Name (ru)',
            'name_ru_helper'       => '',
            'name_en'              => 'Name (en)',
            'name_en_helper'       => '',
            'type'              => 'Type',
            'type_helper'       => '',
            'hidden'              => 'Hidden',
            'hidden_helper'       => '',
            'date_range'              => 'Date Range',
            'date_range_helper'       => '',
            'date_range_from'              => 'Date Range From',
            'date_range_from_helper'       => '',
            'date_range_to'              => 'Date Range To',
            'date_range_to_helper'       => '',
        ],
    ],
    'languages'                     => [
        'title'          => 'Languages',
        'title_singular' => 'Language',
        'fields'         => [
            'locale'              => 'Locale',
            'locale_helper'       => '',
            'active'              => 'Active',
            'active_helper'       => ''
        ],
    ],
    'pages'                     => [
        'title'          => 'Pages',
        'title_singular' => 'Page',
        'fields'         => [
            'name'              => 'Name',
            'name_helper'       => '',
            'title'              => 'Title',
            'title_helper'       => '',
            'meta_title'              => 'Meta Title',
            'meta_title_helper'       => '',
            'meta_description'              => 'Meta Description',
            'meta_description_helper'       => '',
        ],
    ],
];
