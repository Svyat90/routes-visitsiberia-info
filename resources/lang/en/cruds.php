<?php

return [
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
    'seasons'                     => [
        'title'          => 'Seasons',
        'title_singular' => 'Season',
        'fields'         => [
            'id'                => 'ID',
            'id_helper'         => '',
            'name'              => 'Name',
            'name_helper'       => '',
            'created_at'        => 'Created at',
            'created_at_helper' => '',
            'updated_at'        => 'Updated at',
            'updated_at_helper' => '',
            'deleted_at'        => 'Deleted at',
            'deleted_at_helper' => '',
        ],
    ],
    'dictionaryManagement'            => [
        'title'          => 'Dictionaries',
        'title_singular' => 'Dictionary',
    ],
];
