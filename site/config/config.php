<?php

use Kirby\Cms\Page;

return [
    'debug'  => true,
    'routes' => [
        [
            'pattern' => 'user-create',
            'action'  => function () {
                return Page::factory([
                    'slug'      => 'user-create',
                    'template'  => 'user-create',
                ]);
            }
        ],
        [
            'pattern' => 'user-panel',
            'action'  => function () {
                return Page::factory([
                    'slug'      => 'user-panel',
                    'template'  => 'user-panel',
                ]);
            }
        ],
        [
            'pattern' => 'user-login',
            'action'  => function () {
                return Page::factory([
                    'slug'      => 'user-login',
                    'template'  => 'user-login',
                ]);
            }
        ],
        [
            'pattern' => 'user-logout',
            'action'  => function () {
                return Page::factory([
                    'slug'      => 'user-logout',
                    'template'  => 'user-logout',
                ]);
            }
        ],
        [
            'pattern' => 'project',
            'action'  => function () {
                return Page::factory([
                    'slug'      => 'project',
                    'template'  => 'project',
                ]);
            }
        ],

        /*
         * PUBLIC
         */
        [
            'pattern' => 'rest.public.data',
            'action'  => function () {
                return Page::factory([
                    'slug'      => 'rest.public.data',
                    'template'  => 'rest.public.data',
                ]);
            }
        ],

        /*
         * USER
         */

         [
            'pattern' => 'rest.user.create',
            'action'  => function () {
                header("Access-Control-Allow-Origin: *");

                return Page::factory([
                    'slug'      => 'rest.user.create',
                    'template'  => 'rest.user.create',
                ]);
            },
            'method' => 'POST',
        ],

        [
            'pattern' => 'rest.user.data',
            'action'  => function () {
                header("Access-Control-Allow-Origin: *");

                return Page::factory([
                    'slug'      => 'rest.user.data',
                    'template'  => 'rest.user.data',
                ]);
            },
            'method' => 'POST',
        ],

        [
            'pattern' => 'rest.user.save',
            'action'  => function () {
                header("Access-Control-Allow-Origin: *");

                return Page::factory([
                    'slug'      => 'rest.user.save',
                    'template'  => 'rest.user.save',
                ]);
            },
            'method' => 'POST',
        ],


        /*
         * OTHER
         */
        [
            'pattern' => '/',
            'action'  => function () {
                return Page::factory([
                    'slug'      => 'home',
                    'template'  => 'default',
                ]);
            }
        ],

        [
            'pattern' => '(:any)',
            'action'  => function () {
                return false;
            }
        ],
    ]
];
