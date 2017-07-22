<?php

namespace App\Admin\Sections;

use SleepingOwl\Admin\Contracts\DisplayInterface;
use SleepingOwl\Admin\Contracts\FormInterface;
use SleepingOwl\Admin\Section;
use AdminColumn;
use AdminColumnFilter;
use AdminDisplayFilter;
use AdminColumnEditable;
use AdminDisplay;
use AdminForm;
use AdminFormElement;
use SleepingOwl\Admin\Contracts\Initializable;
use KodiComponents\Navigation\Badge;

use Carbon\Carbon;

use App\Model\StaticText;
use App\Model\Lng\StaticTextAddRu;
use App\Model\Lng\StaticTextAddEn;

use SleepingOwl\Admin\Form\Buttons\Save;
use SleepingOwl\Admin\Form\Buttons\SaveAndClose;
use SleepingOwl\Admin\Form\Buttons\Cancel;
use SleepingOwl\Admin\Form\Buttons\Delete;

class StaticTexts extends Section implements Initializable
{
    public function initialize()
    {
    }

    protected $checkAccess = false;
    protected $alias = 'static/list';

    public function getIcon()
    {
        return 'fa fa-indent';
    }
    public function getTitle()
    {
        return trans('admin.adm_static_list_header');
    }
    public function getEditTitle()
    {
        return trans('admin.adm_static_edit');
    }
    public function getCreateTitle()
    {
        return trans('admin.adm_static_create');
    }

    public function onDisplay()
    {
        $columns = [
            AdminColumn::text('id', trans('admin.adm_id'))->setWidth('30px'),
            AdminColumn::link(function ($model) {
                echo '<a href="../'. $this->alias .'/'. $model->id.'/edit">'
                    . $model->name .'</a><br /><small>'. $model->alias .'</small>';
            }, trans('admin.adm_label')),

            AdminColumn::custom(trans('admin.adm_published'), function ($model) {
                $publ = '<i class="fa fa-close text-primary"></i>';
                $date = Carbon::now()->format('Y-m-d H:i:s');
                if ($model->published) {
                    $publ = '<i class="fa fa-check text-success"></i>';
                    if (Carbon::parse($date) < Carbon::parse($model->publish_up)) {
                        $publ ='<i class="fa fa-pause text-warning" data-toggle="tooltip" title="'. trans('admin.adm_date_up') .' '. $model->publish_up .'"></i>';
                    }
                    if ($model->publish_down and $date > $model->publish_down) {
                        $publ ='<i class="fa fa-stop text-danger" data-toggle="tooltip" title="'. trans('admin.adm_date_down') .' '. $model->publish_down .'"></i>';
                    }
                }
                return $publ;
            })->setWidth('50px')->setHtmlAttribute('class', 'text-center'),
            AdminColumn::relatedLink('StaticAddRu.title', trans('admin.adm_lng_ru'))
            ->setWidth('150px')->setHtmlAttribute('class', 'text-center'),
            AdminColumn::relatedLink('StaticAddEn.title', trans('admin.adm_lng_en'))
            ->setWidth('150px')->setHtmlAttribute('class', 'text-center'),
            AdminColumn::custom(trans('admin.adm_user_id'), function ($instance) {
                return $instance->updated_at ? $instance->user['username']
                .'<br/><small>'. $instance->updated_at .'</small>' : '<i class="fa fa-minus"></i>';
            })->setWidth('150px')->setHtmlAttribute('class', 'text-center'),
        ];

        $tableActive =  AdminDisplay::datatables()
            ->setModelClass(StaticText::class)
            ->paginate(25)->getScopes()->set('StaticActive')->setColumns($columns)
            ->setHtmlAttribute('class', 'table-success table-hover th-center');
        $tableDraft =  AdminDisplay::datatables()
            ->setModelClass(StaticText::class)
            ->paginate(25)->getScopes()->set('StaticDraft')->setColumns($columns)
            ->setHtmlAttribute('class', 'table-warning table-hover th-center');
        $tableDeleted =  AdminDisplay::datatables()
            ->setModelClass(StaticText::class)
            ->paginate(25)->getScopes()->set('StaticDel')->setColumns($columns)
            ->setHtmlAttribute('class', 'table-danger table-hover th-center');

        $tabs = AdminDisplay::tabbed();

        $tabs->setElements([
            AdminDisplay::tab($tableActive)
                ->setLabel(trans('admin.adm_active2'))->seticon('<i class="fa fa-eye"></i>')
                ->setBadge(function () {
                    return StaticText::StaticActive()->count();
                }),
            AdminDisplay::tab($tableDraft)
                ->setLabel(trans('admin.adm_drafts'))->seticon('<i class="fa fa-eye-slash"></i>')
                ->setBadge(function () {
                    return StaticText::StaticDraft()->count();
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
                AdminFormElement::text('name', trans('admin.adm_label'))->required(),
                AdminFormElement::checkbox('published', trans('admin.adm_published')),
                AdminFormElement::text('alias', trans('admin.adm_alias'))->unique(),
                // Языковая связка
                AdminFormElement::columns()->addColumn([
                    AdminFormElement::select('ru', trans('admin.adm_lng_ru_link'), StaticTextAddRu::class)
                                    ->setDisplay('title')->nullable(), //->unique()
                ], 6)->addColumn([
                    AdminFormElement::select('en', trans('admin.adm_lng_en_link'), StaticTextAddEn::class)
                                    ->setDisplay('title')->nullable(), //->unique()
                ]),

            ], 9)->addColumn([
                AdminFormElement::text('id', trans('admin.adm_id'))->setReadonly(1),
                AdminFormElement::timestamp('created_at', trans('admin.adm_created1'))->setReadonly(1),
                AdminFormElement::datetime('publish_up', trans('admin.adm_publish_up')),
                AdminFormElement::datetime('publish_down', trans('admin.adm_publish_down')),
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
