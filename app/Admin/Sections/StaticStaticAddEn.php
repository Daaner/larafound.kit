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

use App\Admin\Model\StaticTextAddEn;

use SleepingOwl\Admin\Form\Buttons\Save;
use SleepingOwl\Admin\Form\Buttons\SaveAndClose;
use SleepingOwl\Admin\Form\Buttons\Cancel;
use SleepingOwl\Admin\Form\Buttons\Delete;

class StaticTextsAddEn extends Section implements Initializable
{

    public function initialize() {
    }

    protected $checkAccess = false;
    protected $alias = 'static/static-en';

    public function getIcon() {
        return 'fa fa-file-text-o';
    }
    public function getTitle() {
        return trans('admin.adm_static_add_en_header');
    }
    public function getEditTitle() {
        return trans('admin.adm_static_edit');
    }
    public function getCreateTitle() {
        return trans('admin.adm_static_create');
    }

    public function onDisplay() {

        $columns = [
            AdminColumn::text('id', trans('admin.adm_id'))->setWidth('30px'),
            AdminColumn::link('title', trans('admin.adm_title')),
            AdminColumnEditable::checkbox('published', trans('admin.adm_published')),

            AdminColumn::custom( trans('admin.adm_metakey'), function ($instance) {
                    return strlen($instance->keywords);})->setWidth('100px'),
            AdminColumn::custom( trans('admin.adm_metadesc'), function ($instance) {
                    return strlen($instance->description);})->setWidth('100px'),
        ];

        $tableActive =  AdminDisplay::datatables()
            ->setModelClass(StaticTextAddEn::class)
            ->paginate(25)->getScopes()->set('StaticActive')->setColumns($columns)
            ->setHtmlAttribute('class', 'table-success table-hover');
        $tableDraft =  AdminDisplay::datatables()
            ->setModelClass(StaticTextAddEn::class)
            ->paginate(25)->getScopes()->set('StaticDraft')->setColumns($columns)
            ->setHtmlAttribute('class', 'table-warning table-hover');
        $tableDeleted =  AdminDisplay::datatables()
            ->setModelClass(StaticTextAddEn::class)
            ->paginate(25)->getScopes()->set('StaticDel')->setColumns($columns)
            ->setHtmlAttribute('class', 'table-danger table-hover');

        $tabs = AdminDisplay::tabbed();

        $tabs->setElements([
            AdminDisplay::tab($tableActive)
                ->setLabel('Активные')->seticon('<i class="fa fa-eye"></i>')
                ->setBadge(function(){
                        return StaticTextAddEn::StaticActive()->count();
                    }),
            AdminDisplay::tab($tableDraft)
                ->setLabel('Черновики')->seticon('<i class="fa fa-eye-slash"></i>')
                ->setBadge(function(){
                        return StaticTextAddEn::StaticDraft()->count();
                    }),
            AdminDisplay::tab($tableDeleted)
                ->setLabel('Удаленные')->seticon('<i class="fa fa-trash"></i>'),
            ]);

        return $tabs;
    }

    public function onEdit($id) {

        $form=AdminForm::panel()->addBody([
            AdminFormElement::text('id', trans('admin.adm_id'))->setReadonly(1),
            AdminFormElement::text('title', trans('admin.adm_role'))->required(),
            // AdminFormElement::radio('published', '1')->setOptions(['0' => 'Not ok', '1' => 'ok']),
            AdminFormElement::textarea('keywords', trans('admin.adm_metakey')),
            AdminFormElement::textarea('description', trans('admin.adm_metadesc')),
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
