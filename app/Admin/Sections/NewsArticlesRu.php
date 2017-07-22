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

use Carbon\Carbon;

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
            AdminColumn::link(function ($instance) {
                echo '<a href="../'. $this->alias .'/'. $instance->id.'/edit">'
                    . $instance->title .'</a><br /><small>'. $instance->alias .'</small>';
            }, trans('admin.adm_title')),
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
            AdminColumn::custom(trans('admin.adm_category'), function ($instance) {
                return $instance->category ? NewsCategoryRu::find($instance->category)->name : '<span class="text-muted">'. trans('admin.adm_parent_null') .'</span>';})
                ->setWidth('200px')->setHtmlAttribute('class', 'text-center'),
            AdminColumn::custom(trans('admin.adm_seo'), function ($instance) {
                $metatitle = iconv_strlen($instance->title);
                $keyword = iconv_strlen($instance->keywords);
                $description = iconv_strlen($instance->description);
                return $metatitle.' / '.$keyword.' / '.$description;
            })->setWidth('150px')->setHtmlAttribute('class', 'text-center'),
            AdminColumn::custom(trans('admin.adm_user_id'), function ($instance) {
                return $instance->updated_at ? $instance->user['username']
                .'<br/><small>'. $instance->updated_at .'</small>' : '<i class="fa fa-minus"></i>';
            })->setWidth('150px')->setHtmlAttribute('class', 'text-center'),

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
            AdminFormElement::wysiwyg('preview_text', trans('admin.adm_text_prev'))->setHeight(100),
            AdminFormElement::wysiwyg('full_text', trans('admin.adm_text_full'))->setHeight(300),
            AdminFormElement::text('links', trans('admin.adm_link')),

          ],7)->addColumn([
            AdminFormElement::text('id', trans('admin.adm_id'))->setReadonly(1),
            AdminFormElement::select('category', trans('admin.adm_parent_cat'), NewsCategoryRu::class)
              ->setDisplay('name')->nullable()->exclude($id),
            AdminFormElement::image('image', trans('admin.adm_image')),
            AdminFormElement::text('video', trans('admin.adm_video')),
            AdminFormElement::textarea('keywords', trans('admin.adm_metakey'))->setRows(3),
            AdminFormElement::textarea('description', trans('admin.adm_metadesc'))->setRows(3),
            AdminFormElement::text('tags', trans('admin.adm_tags')),



            AdminFormElement::columns()->addColumn([
              AdminFormElement::datetime('publish_up', trans('admin.adm_publish_up')),
              AdminFormElement::timestamp('created_at', trans('admin.adm_created1'))->setReadonly(1),
            ], 6)->addColumn([
              AdminFormElement::datetime('publish_down', trans('admin.adm_publish_down')),
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
