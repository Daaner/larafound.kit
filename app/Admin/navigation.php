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
    [
        'title' => trans('admin.adm_users_group'),
        'icon' => 'fa fa-users',
        'priority' => 300,
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
