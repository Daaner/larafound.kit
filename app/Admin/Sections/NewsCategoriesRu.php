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

use App\Model\Lng\NewsCategoryRu;

use SleepingOwl\Admin\Form\Buttons\Save;
use SleepingOwl\Admin\Form\Buttons\SaveAndClose;
use SleepingOwl\Admin\Form\Buttons\Cancel;
use SleepingOwl\Admin\Form\Buttons\Delete;

class NewsCategoriesRu extends Section implements Initializable
{
    public function initialize()
    {
    }

    protected $checkAccess = false;
    protected $alias = 'news/category-ru';

    public function getIcon()
    {
        return 'fa fa-folder-open';
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
            AdminColumn::link('name', trans('admin.adm_title')),
            AdminColumn::custom(trans('admin.adm_parent'), function ($instance) {
                return $instance->parent ? NewsCategoryRu::find($instance->parent)->name : '<span class="text-muted">'. trans('admin.adm_parent_null') .'</span>';})
                ->setWidth('200px')->setHtmlAttribute('class', 'text-center'),
            AdminColumn::text('alias', trans('admin.adm_alias')),
            AdminColumn::custom(trans('admin.adm_published'), function ($instance) {
                return $instance->published ? '<i class="fa fa-check"></i>' : '<i class="fa fa-minus"></i>';})
                    ->setWidth('30px')->setHtmlAttribute('class', 'text-center'),

            AdminColumn::custom(trans('admin.adm_user_id'), function ($instance) {
                return $instance->updated_at ? $instance->user['username']
                .'<br/><small>'. $instance->updated_at .'</small>' : '<i class="fa fa-minus"></i>';
            })->setWidth('150px')->setHtmlAttribute('class', 'text-center')->setOrderable(false),
        ];

        $tableActive =  AdminDisplay::datatables()
            ->setModelClass(NewsCategoryRu::class)
            ->paginate(25)->getScopes()->set('NewsCatActive')->setColumns($columns)
            ->setHtmlAttribute('class', 'table-success table-hover th-center');
        $tableDraft =  AdminDisplay::datatables()
            ->setModelClass(NewsCategoryRu::class)
            ->paginate(25)->getScopes()->set('NewsCatDraft')->setColumns($columns)
            ->setHtmlAttribute('class', 'table-warning table-hover th-center');
        $tableDeleted =  AdminDisplay::datatables()
            ->setModelClass(NewsCategoryRu::class)
            ->paginate(25)->getScopes()->set('NewsCatDel')->setColumns($columns)
            ->setHtmlAttribute('class', 'table-danger table-hover th-center');

        $tabs = AdminDisplay::tabbed();

        $tabs->setElements([
            AdminDisplay::tab($tableActive)
                ->setLabel(trans('admin.adm_active2'))->seticon('<i class="fa fa-eye"></i>')
                ->setBadge(function () {
                    return NewsCategoryRu::NewsCatActive()->count();
                }),
            AdminDisplay::tab($tableDraft)
                ->setLabel(trans('admin.adm_drafts'))->seticon('<i class="fa fa-eye-slash"></i>')
                ->setBadge(function () {
                    return NewsCategoryRu::NewsCatDraft()->count();
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
            AdminFormElement::text('name', trans('admin.adm_title'))->required(),
            AdminFormElement::checkbox('published', trans('admin.adm_published')),
            AdminFormElement::text('alias', trans('admin.adm_alias')),
            AdminFormElement::wysiwyg('info', trans('admin.adm_text_cat')),

          ],7)->addColumn([
            AdminFormElement::text('id', trans('admin.adm_id'))->setReadonly(1),
            AdminFormElement::select('parent', trans('admin.adm_parent_cat'), NewsCategoryRu::class)
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
