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

class UsersAdm extends Section implements Initializable
{
    public function initialize()
    {
        $this->creating(function ($config, \Illuminate\Database\Eloquent\Model $model) {
        });
    }

    protected $checkAccess = false;
    protected $alias = 'admins';

    public function getIcon()
    {
        return 'fa fa-user-md';
    }
    public function getTitle()
    {
        return trans('admin.adm_users_admins');
    }
    public function getEditTitle()
    {
        return trans('admin.adm_users_edit');
    }

    public function onDisplay()
    {
        $display = AdminDisplay::datatablesAsync()->setHtmlAttribute('class', 'table-warning table-hover');
//        $display = AdminDisplay::datatables()->setHtmlAttribute('class', 'table-primary table-hover');

        $display->setOrder([[0, 'asc']]);

        $display->setColumns([
            AdminColumn::text('id', trans('admin.adm_id'))->setWidth('30px'),
            AdminColumn::link('username', trans('admin.adm_username')),
            AdminColumn::link('name', trans('admin.adm_name')),
            AdminColumn::text('email', trans('admin.adm_email')),
            AdminColumn::custom(trans('admin.adm_role'), function ($instance) {
                return $instance->roles->name;
            })->setWidth('150px'),
        ]);
        $display->paginate(25)->getScopes()->set('UsrAdm');

        return $display;
    }

    public function onEdit($id)
    {
        $form=AdminForm::panel()->addBody([
            AdminFormElement::columns()->addColumn([
                AdminFormElement::text('id', trans('admin.adm_id'))->required()->setReadonly(1),
                AdminFormElement::image('avatar', trans('admin.adm_avatar')),
            ], 3)->addColumn([
                AdminFormElement::text('name', trans('admin.adm_name'))->required(),
                AdminFormElement::text('username', trans('admin.adm_username'))->required(),
                AdminFormElement::text('email', trans('admin.adm_email'))->required(),
                AdminFormElement::checkbox('active', trans('admin.adm_email_check')),
                AdminFormElement::select('role_id', trans('admin.adm_role'), Role::class)
                                ->setDisplay('name')->setSortable(false)->required(),
                // AdminFormElement::password('password', trans('admin.adm_password')),
            ]),

            AdminFormElement::columns()->addColumn([
                AdminFormElement::datetime('created_at', trans('admin.adm_created'))->setReadonly(1),
            ], 3)->addColumn([
                AdminFormElement::text('signup_ip', trans('admin.adm_ip_sign'))->setReadonly(1),
            ], 3)->addColumn([
                AdminFormElement::text('confirm_ip', trans('admin.adm_ip_confirm'))->setReadonly(1),
            ], 3)
        ]);

        $form->getButtons()->setButtons([
            'save'  => new Save(),
            'save_and_close'  => new SaveAndClose(),
            'cancel'  => (new Cancel()),
            'delete' => new Delete(),
        ]);

        return $form;
    }
}
