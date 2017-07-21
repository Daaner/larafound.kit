<?php

use SleepingOwl\Admin\Navigation\Page;

return [
    [
        'title' => trans('admin.adm_dashboard'),
        'icon'  => 'fa fa-dashboard',
        'url'   => route('admin.dashboard'),
    ],
    [
        'title' => trans('admin.adm_information'),
        'icon'  => 'fa fa-exclamation-circle',
        'url'   => route('admin.information'),
    ],

    //static
    [
        'title' => trans('admin.adm_static'),
        'icon' => 'fa fa-file-text',
        'priority' => 400,
        'pages' =>
        [
            (new Page(\App\Model\StaticText::class))
                ->setTitle(trans('admin.adm_static_list'))
                ->setPriority(100),
            (new Page(\App\Model\Lng\StaticTextAddRu::class))
                ->setTitle(trans('admin.adm_static_add_ru'))
                ->setPriority(200),
            (new Page(\App\Model\Lng\StaticTextAddEn::class))
                ->setTitle(trans('admin.adm_static_add_en'))
                ->setPriority(300),
        ],
    ],

    //news
    [
        'title' => trans('admin.adm_news_category'),
        'icon' => 'fa fa-newspaper-o',
        'priority' => 400,
        'pages' =>
        [
            (new Page(\App\Model\Lng\NewsCategoryRu::class))
                ->setTitle(trans('admin.adm_news_cat_add_ru'))
                ->setPriority(100),
            (new Page(\App\Model\Lng\NewsCategoryEn::class))
                ->setTitle(trans('admin.adm_news_cat_add_en'))
                ->setPriority(200),
            (new Page(\App\Model\Lng\NewsArticleRu::class))
                ->setTitle(trans('admin.adm_news_article_ru'))
                ->setPriority(300),

        ],
    ],

    //users
    [
        'title' => trans('admin.adm_users_group'),
        'icon' => 'fa fa-users',
        'priority' => 900,
        'pages' =>
        [
            (new Page(\App\Admin\Model\UserAll::class))
                ->setTitle(trans('admin.adm_all'))
                ->setPriority(100),
            (new Page(\App\Admin\Model\UserModer::class))
                ->setTitle(trans('admin.adm_users_moderators'))
                ->setPriority(200),
            (new Page(\App\Admin\Model\UserAdm::class))
                ->setTitle(trans('admin.adm_users_admins'))
                ->setPriority(300),
            (new Page(\App\Admin\Model\UserDel::class))
                ->setTitle(trans('admin.adm_deletes'))
                ->setPriority(400),
        ],
    ]
];
