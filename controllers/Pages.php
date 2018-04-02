<?php namespace SamPoyigi\Pages\Controllers;

use AdminMenu;

class Pages extends \Admin\Classes\AdminController
{
    public $implement = [
        'Admin\Actions\ListController',
        'Admin\Actions\FormController',
    ];

    public $listConfig = [
        'list' => [
            'model'        => 'SamPoyigi\Pages\Models\Pages_model',
            'title'        => 'lang:sampoyigi.pages::default.text_title',
            'emptyMessage' => 'lang:sampoyigi.pages::default.text_empty',
            'defaultSort'  => ['country_name', 'ASC'],
            'configFile'   => 'pages_model',
        ],
    ];

    public $formConfig = [
        'name'       => 'lang:sampoyigi.pages::default.text_form_name',
        'model'      => 'SamPoyigi\Pages\Models\Pages_model',
        'create'     => [
            'title'         => 'lang:admin::default.form.create_title',
            'redirect'      => 'sampoyigi/pages/pages/edit/{page_id}',
            'redirectClose' => 'pages',
        ],
        'edit'       => [
            'title'         => 'lang:admin::default.form.edit_title',
            'redirect'      => 'sampoyigi/pages/pages/edit/{page_id}',
            'redirectClose' => 'pages',
        ],
        'delete'     => [
            'redirect' => 'pages',
        ],
        'configFile' => 'pages_model',
    ];

    protected $requiredPermissions = 'Site.Pages';

    public function __construct()
    {
        parent::__construct();

        AdminMenu::setContext('pages', 'design');
    }

    public function formValidate($model, $form)
    {
        $rules[] = ['language_id', 'lang:sampoyigi.pages::default.label_language', 'required|integer'];
        $rules[] = ['name', 'lang:sampoyigi.pages::default.label_name', 'required|min:2|max:255'];
        $rules[] = ['title', 'lang:sampoyigi.pages::default.label_title', 'required|min:2|max:255'];
        $rules[] = ['permalink_slug', 'lang:sampoyigi.pages::default.label_permalink_slug', 'max:255'];
        $rules[] = ['content', 'lang:sampoyigi.pages::default.label_content', 'required|min:2'];
        $rules[] = ['meta_description', 'lang:sampoyigi.pages::default.label_meta_description', 'min:2|max:255'];
        $rules[] = ['meta_keywords', 'lang:sampoyigi.pages::default.label_meta_keywords', 'min:2|max:255'];
        $rules[] = ['layout_id', 'lang:sampoyigi.pages::default.label_layout', 'integer'];
        $rules[] = ['navigation.*', 'lang:sampoyigi.pages::default.label_navigation', 'required'];
        $rules[] = ['status', 'lang:admin::default.label_status', 'required|integer'];

        return $this->validatePasses($form->getSaveData(), $rules);
    }
}