<?php

namespace App\Admin\Sections;

use SleepingOwl\Admin\Contracts\DisplayInterface;
use SleepingOwl\Admin\Contracts\FormInterface;
use SleepingOwl\Admin\Section;
use AdminColumn;
use AdminColumnFilter;
use AdminDisplayFilter;
use AdminDisplay;
use AdminForm;
use AdminFormElement;
use SleepingOwl\Admin\Contracts\Initializable;

use AdminColumnEditable;

use SleepingOwl\Admin\Form\Buttons\Save;
use SleepingOwl\Admin\Form\Buttons\SaveAndClose;
use SleepingOwl\Admin\Form\Buttons\Cancel;
use SleepingOwl\Admin\Form\Buttons\Delete;

use App\Model\StaticText;

class StaticTexts extends Section implements Initializable
{

    public function initialize() {
        $model = $this;
    }

    protected $checkAccess = false;
    protected $alias = 'static';

    public function getIcon() {
        return 'fa fa-indent';
    }
    public function getTitle() {
        return trans('admin.adm_static_list_header');
    }
    public function getEditTitle() {
        return trans('admin.adm_static_edit');
    }
    public function getCreateTitle() {
        return trans('admin.adm_static_create');
    }

    public function onDisplay() {

       $display = AdminDisplay::datatables()->setHtmlAttribute('class', 'table-success table-hover th-center');

        $display->setOrder([[0, 'asc']]);

        $display->setColumns([
            AdminColumn::text('id', trans('admin.adm_id'))->setWidth('30px'),
            AdminColumn::link('name', trans('admin.adm_label')),
            AdminColumnEditable::checkbox('published', trans('admin.adm_published')),

            AdminColumn::relatedLink('StaticAddru.title', trans('admin.adm_lng_ru'))
                        ->setWidth('150px')->setHtmlAttribute('class', 'text-center'),
            AdminColumn::relatedLink('StaticAdden.title', trans('admin.adm_lng_en'))
                        ->setWidth('150px')->setHtmlAttribute('class', 'text-center'),

            AdminColumn::custom(trans('admin.adm_user_id'), function ($model) {
                return $model->updated_at ? $model->user['username'] .'<br/><small>'. $model->updated_at .'</small>' : '<i class="fa fa-minus"></i>';
            })->setWidth('150px')->setHtmlAttribute('class', 'text-center')->setOrderable(false),
        ]);
        $display->getColumns()->getControlColumn();

        return $display;
    }

    public function onEdit($id) {

        $form=AdminForm::panel()->addBody([
            AdminFormElement::text('id', trans('admin.adm_id'))->setReadonly(1),
            AdminFormElement::text('name', trans('admin.adm_role'))->required(),
            // AdminFormElement::textarea('description', trans('admin.adm_desc')),
            AdminFormElement::hidden('user_id')->setDefaultValue(auth()->user()->id),
        ]);

        $form->getButtons()->setButtons ([
            'save'  => new Save(),
            'save_and_close'  => new SaveAndClose(),
            'cancel'  => (new Cancel()),
            'delete' => new Delete(),
        ]);

        return $form;
    }

    public function onCreate() {

        return $this->onEdit(null);
    }
}
