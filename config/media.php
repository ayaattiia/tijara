<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Media Base URL
    |--------------------------------------------------------------------------
    |
    | Single place that defines the domain used to build public file URLs.
    | Every table stores ONLY the filename — never the full path or domain.
    | The full URL is always assembled from this value + the folder below.
    |
    */

    'base_url' => env('MEDIA_BASE_URL', env('APP_URL')),

    /*
    |--------------------------------------------------------------------------
    | Folder map
    |--------------------------------------------------------------------------
    |
    | 'ads' and 'products' split into images/videos (confirmed folders on
    | disk). 'chats' and 'deals' are flat — Deals only has one image field
    | and no video field, and Message only has one attachment field, so
    | there's no images/videos split for either.
    |
    */

    'paths' => [
        'ads' => [
            'images' => 'assets/ads/images',
            'videos' => 'assets/ads/videos',
        ],
        'products' => [
            'images' => 'assets/products/images',
            'videos' => 'assets/products/videos',
        ],
        'chats'          => 'assets/chats',
        'deals'          => 'assets/deals',
        'identity'       => 'assets/identity',
        'users_profiles' => 'assets/users/profiles',
    ],

];
