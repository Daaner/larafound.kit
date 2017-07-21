<?php

namespace App\Admin\Sections;

use SleepingOwl\Admin\Contracts\DisplayInterface;
use SleepingOwl\Admin\Contracts\FormInterface;
use SleepingOwl\Admin\Section;
use AdminColumn;
use AdminColumnEditable;
use AdminColumnFilter;
use AdminDisplayFilter;
use AdminDisplay;
use AdminForm;
use AdminFormElement;
use SleepingOwl\Admin\Contracts\Initializable;
use KodiComponents\Navigation\Badge;

use App\Model\Lng\NewsArticleRu;
use App\Model\Lng\NewsCategoryRu;

use SleepingOwl\Admin\Form\Buttons\Save;
use SleepingOwl\Admin\Form\Buttons\SaveAndClose;
use SleepingOwl\Admin\Form\Buttons\Cancel;
use SleepingOwl\Admin\Form\Buttons\Delete;

class NewsArticlesRu extends Section implements Initializable
{
    public function initialize()
    {
    }

    protected $checkAccess = false;
    protected $alias = 'news/article-ru';

    public function getIcon()
    {
        return 'fa fa-file-text';
    }
    public function getTitle()
    {
        return trans('admin.adm_news_category_ru_header');
    }
    public function getEditTitle()
    {
        return trans('admin.adm_news_category_edit');
    }
    public function getCreateTitle()
    {
        return trans('admin.adm_news_category_create');
    }

    public function onDisplay()
    {
        $columns = [
            AdminColumn::text('id', trans('admin.adm_id'))->setWidth('30px'),
            AdminColumn::link('title', trans('admin.adm_title')),

        ];

        $tableActive =  AdminDisplay::datatables()
            ->setModelClass(NewsArticleRu::class)
            ->paginate(25)->getScopes()->set('NewsActive')->setColumns($columns)
            ->setHtmlAttribute('class', 'table-success table-hover th-center');
        $tableDraft =  AdminDisplay::datatables()
            ->setModelClass(NewsArticleRu::class)
            ->paginate(25)->getScopes()->set('NewsDraft')->setColumns($columns)
            ->setHtmlAttribute('class', 'table-warning table-hover th-center');
        $tableDeleted =  AdminDisplay::datatables()
            ->setModelClass(NewsArticleRu::class)
            ->paginate(25)->getScopes()->set('NewsDel')->setColumns($columns)
            ->setHtmlAttribute('class', 'table-danger table-hover th-center');

        $tabs = AdminDisplay::tabbed();

        $tabs->setElements([
            AdminDisplay::tab($tableActive)
                ->setLabel(trans('admin.adm_active2'))->seticon('<i class="fa fa-eye"></i>')
                ->setBadge(function () {
                    return NewsArticleRu::NewsActive()->count();
                }),
            AdminDisplay::tab($tableDraft)
                ->setLabel(trans('admin.adm_drafts'))->seticon('<i class="fa fa-eye-slash"></i>')
                ->setBadge(function () {
                    return NewsArticleRu::NewsDraft()->count();
                }),
            AdminDisplay::tab($tableDeleted)
                ->setLabel(trans('admin.adm_deletes'))->seticon('<i class="fa fa-trash"></i>')->setHtmlAttribute('class', 'tab-delete'),
            ]);

        return $tabs;
    }

    public function onEdit($id)
    {
        $form=AdminForm::panel()->addBody([
          AdminFormElement::columns()->addColumn([
            AdminFormElement::text('title', trans('admin.adm_title'))->required(),
            AdminFormElement::checkbox('published', trans('admin.adm_published')),
            AdminFormElement::text('alias', trans('admin.adm_alias')),


          ],7)->addColumn([
            AdminFormElement::text('id', trans('admin.adm_id'))->setReadonly(1),
            AdminFormElement::select('category', trans('admin.adm_parent_cat'), NewsCategoryRu::class)
            ->setDisplay('name')->nullable()->exclude($id),
            AdminFormElement::image('image', trans('admin.adm_image')),

            AdminFormElement::timestamp('created_at', trans('admin.adm_created1'))->setReadonly(1),
            AdminFormElement::timestamp('updated_at', trans('admin.adm_updated'))->setReadonly(1),
            AdminFormElement::hidden('user_id')->setDefaultValue(auth()->user()->id),
          ]),
        ]);

        $form->getButtons()->setButtons([
            'save'  => new Save(),
            'save_and_close'  => new SaveAndClose(),
            'cancel'  => (new Cancel()),
            'delete' => new Delete(),
        ]);

        return $form;
    }

    public function onCreate()
    {
        return $this->onEdit(null);
    }
}
