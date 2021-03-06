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

use App\Model\Lng\StaticTextAddRu;

use SleepingOwl\Admin\Form\Buttons\Save;
use SleepingOwl\Admin\Form\Buttons\SaveAndClose;
use SleepingOwl\Admin\Form\Buttons\Cancel;
use SleepingOwl\Admin\Form\Buttons\Delete;

class StaticTextsAddRu extends Section implements Initializable
{
    public function initialize()
    {
    }

    protected $checkAccess = false;
    protected $alias = 'static-ru';

    public function getIcon()
    {
        return 'fa fa-file-text-o';
    }
    public function getTitle()
    {
        return trans('admin.adm_static_add_ru_header');
    }
    public function getEditTitle()
    {
        return trans('admin.adm_static_edit_ru');
    }
    public function getCreateTitle()
    {
        return trans('admin.adm_static_create');
    }

    public function onDisplay()
    {
        $columns = [
            AdminColumn::text('id', trans('admin.adm_id'))->setWidth('30px'),
            AdminColumn::link('title', trans('admin.adm_title')),
            AdminColumn::relatedLink('stextru.name', trans('admin.adm_related')),

            AdminColumn::custom(trans('admin.adm_seo'), function ($instance) {
                $metatitle = iconv_strlen($instance->title);
                $keyword = iconv_strlen($instance->keywords);
                $description = iconv_strlen($instance->description);
                return '<p class="text-center">'. $metatitle.' / '.$keyword.' / '.$description .'</p>';
            })->setWidth('150px'),
            AdminColumn::custom(trans('admin.adm_user_id'), function ($instance) {
                return $instance->updated_at ? $instance->user['username']
                .'<br/><small>'. $instance->updated_at .'</small>' : '<i class="fa fa-minus"></i>';
            })->setWidth('150px'),
        ];

        $tableActive =  AdminDisplay::datatablesAsync()
            ->setName('static-ru-actives')
            ->setModelClass(StaticTextAddRu::class)
            ->paginate(25)->getScopes()->set('StaticActive')->setColumns($columns)
            ->setHtmlAttribute('class', 'table-success table-hover th-center');
        $tableDraft =  AdminDisplay::datatablesAsync()
            ->setName('static-ru-drafts')
            ->setModelClass(StaticTextAddRu::class)
            ->paginate(25)->getScopes()->set('StaticDraft')->setColumns($columns)
            ->setHtmlAttribute('class', 'table-warning table-hover th-center');
        $tableDeleted =  AdminDisplay::datatablesAsync()
            ->setName('static-ru-deletes')
            ->setModelClass(StaticTextAddRu::class)
            ->paginate(25)->getScopes()->set('StaticDel')->setColumns($columns)
            ->setHtmlAttribute('class', 'table-danger table-hover th-center');

        $tabs = AdminDisplay::tabbed();

        $tabs->setElements([
            AdminDisplay::tab($tableActive)
                ->setLabel(trans('admin.adm_active2'))->seticon('<i class="fa fa-eye"></i>')
                ->setBadge(function () {
                    return StaticTextAddRu::StaticActive()->count();
                }),
            AdminDisplay::tab($tableDraft)
                ->setLabel(trans('admin.adm_drafts'))->seticon('<i class="fa fa-eye-slash"></i>')
                ->setBadge(function () {
                    return StaticTextAddRu::StaticDraft()->count();
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
            AdminFormElement::text('stextru.name', trans('admin.adm_related'))->setReadonly(1),
            AdminFormElement::wysiwyg('preview_text', trans('admin.adm_text_prev'))->setHeight(100),
            AdminFormElement::wysiwyg('full_text', trans('admin.adm_text_full'))->setHeight(300),
          ],7)->addColumn([
            AdminFormElement::text('id', trans('admin.adm_id'))->setReadonly(1),
            AdminFormElement::image('picture', trans('admin.adm_image')),
            AdminFormElement::text('video', trans('admin.adm_video')),
            AdminFormElement::textarea('keywords', trans('admin.adm_metakey'))->setRows(3),
            AdminFormElement::textarea('description', trans('admin.adm_metadesc'))->setRows(3),
            AdminFormElement::columns()->addColumn([
              AdminFormElement::timestamp('created_at', trans('admin.adm_created1'))->setReadonly(1),
            ], 6)->addColumn([
              AdminFormElement::timestamp('updated_at', trans('admin.adm_updated'))->setReadonly(1),
            ]),
            AdminFormElement::hidden('user_id')->setDefaultValue(auth()->user()->id),
          ]),
          AdminFormElement::columns()->addColumn([
            AdminFormElement::images('images', trans('admin.adm_images'))->storeAsJson(),
          ], 12),
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
