<?php

return [
    'defaults' => [
        'api' => [
            'title' => env('L5_SWAGGER_API_TITLE', 'API Documentation'),
        ],

        'routes' => [
            /*
             * Route for accessing api documentation interface
             */
            'api' => 'api/documentation',
        ],

        'paths' => [
            /*
             * Absolute path to location where parsed annotations will be stored
             */
            'docs' => storage_path('api-docs'),

            /*
             * File name for the generated json documentation file
             */
            'docs_json' => 'api-docs.json',

            /*
             * File name for the generated yaml documentation file
             */
            'docs_yaml' => 'api-docs.yaml',

            /*
             * Absolute paths to directory containing the swagger annotations are stored.
             */
            'annotations' => [
                base_path('app'),
            ],

            /*
             * Absolute paths to directories that should be excluded from swagger generation
             */
            'excludes' => [
                base_path('vendor'),
                base_path('storage'),
                base_path('resources'),
                base_path('bootstrap'),
                base_path('config'),
                base_path('database'),
                base_path('public'),
                base_path('node_modules'),
            ],

            /*
             * Base path for the generated documentation.
             */
            'base' => env('L5_SWAGGER_BASE_PATH', null),
        ],
    ],
];
