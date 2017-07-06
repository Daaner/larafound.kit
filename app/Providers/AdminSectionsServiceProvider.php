<?php

namespace App\Providers;

use SleepingOwl\Admin\Providers\AdminSectionsServiceProvider as ServiceProvider;

class AdminSectionsServiceProvider extends ServiceProvider
{

    /**
     * @var array
     */
    protected $sections = [
        \App\Admin\Model\UserAll::class        => '\App\Admin\Sections\UsersAll',
        \App\Admin\Model\UserModer::class      => '\App\Admin\Sections\UsersModer',
        \App\Admin\Model\UserAdm::class        => '\App\Admin\Sections\UsersAdm',
        \App\Admin\Model\UserDel::class        => '\App\Admin\Sections\UsersDel',
    ];

    /**
     * Register sections.
     *
     * @return void
     */
    public function boot(\SleepingOwl\Admin\Admin $admin)
    {
    	//

        parent::boot($admin);
    }
}
