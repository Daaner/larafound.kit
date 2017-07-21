<?php

namespace App\Providers;

use SleepingOwl\Admin\Contracts\Widgets\WidgetsRegistryInterface;
use SleepingOwl\Admin\Providers\AdminSectionsServiceProvider as ServiceProvider;

class AdminSectionsServiceProvider extends ServiceProvider
{
    protected $widgets = [
        \App\Admin\Widgets\NavigationUserBlock::class
    ];

    /**
     * @var array
     */
    protected $sections = [
        \App\Admin\Model\UserAll::class        => 'App\Admin\Sections\UsersAll',
        \App\Admin\Model\UserModer::class      => 'App\Admin\Sections\UsersModer',
        \App\Admin\Model\UserAdm::class        => 'App\Admin\Sections\UsersAdm',
        \App\Admin\Model\UserDel::class        => 'App\Admin\Sections\UsersDel',
        \App\Role::class                       => 'App\Admin\Sections\Roles',

        \App\Model\StaticText::class                => 'App\Admin\Sections\StaticTexts',
        \App\Model\Lng\StaticTextAddRu::class     => 'App\Admin\Sections\StaticTextsAddRu',
        \App\Model\Lng\StaticTextAddEn::class     => 'App\Admin\Sections\StaticTextsAddEn',

        \App\Model\Lng\NewsCategoryRu::class     => 'App\Admin\Sections\NewsCategoriesRu',
        \App\Model\Lng\NewsCategoryEn::class     => 'App\Admin\Sections\NewsCategoriesEn',
    ];

    /**
     * Register sections.
     *
     * @return void
     */
    public function boot(\SleepingOwl\Admin\Admin $admin)
    {
        //
        $this->loadViewsFrom(base_path("resources/views/admin"), 'admin');

        parent::boot($admin);

        $this->app->call([$this, 'registerViews']);
    }

    public function registerViews(WidgetsRegistryInterface $widgetsRegistry)
    {
        foreach ($this->widgets as $widget) {
            $widgetsRegistry->registerWidget($widget);
        }
    }
}
