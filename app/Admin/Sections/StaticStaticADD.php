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

use App\User;
use App\Role;

use SleepingOwl\Admin\Form\Buttons\Save;
use SleepingOwl\Admin\Form\Buttons\SaveAndClose;
use SleepingOwl\Admin\Form\Buttons\Cancel;
use SleepingOwl\Admin\Form\Buttons\Delete;

class StaticTextsADD extends Section implements Initializable
{

    public function initialize() {
        $this->addToNavigation()
            ->setPriority(500);
    }

    protected $checkAccess = false;
    protected $alias = 'static-add';

    public function getIcon() {
        return 'fa fa-list';
    }
    public function getTitle() {
        return trans('admin.adm_static');
    }
    public function getEditTitle() {
        return trans('admin.adm_static_edit');
    }
    public function getCreateTitle() {
        return trans('admin.adm_static_create');
    }

    public function onDisplay() {

       $display = AdminDisplay::datatables()->setHtmlAttribute('class', 'table-danger table-hover');

        $display->setOrder([[0, 'asc']]);

        $display->setColumns([
            AdminColumn::text('id', trans('admin.adm_id'))->setWidth('30px'),
            AdminColumn::link('title', trans('admin.adm_role')),
            // AdminColumn::text('description', trans('admin.adm_desc')),
            // AdminColumn::count('users.id', trans('admin.adm_users_2'))
            //     ->setWidth('120px')
            //     ->setHtmlAttribute('class', 'text-center'),
        ]);
        $display->getColumns()->getControlColumn();
        $display->paginate(25)->getScopes()->set('StaticRU');

        return $display;
    }

    public function onEdit($id) {

        $form=AdminForm::panel()->addBody([
            AdminFormElement::text('id', trans('admin.adm_id'))->setReadonly(1),
            AdminFormElement::text('title', trans('admin.adm_role'))->required(),
            // AdminFormElement::textarea('description', trans('admin.adm_desc')),
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
