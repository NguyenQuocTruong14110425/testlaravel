<?php namespace Box\Entity\Validation\NewsCategories;

use Box\Entity\Validation\ValidableInterface;
use Box\Entity\Validation\Source\LaravelValidator;

class NewsCategoriesUpdateValidator extends LaravelValidator implements ValidableInterface {

    /**
     * Validation for creating a new User
     *
     * @var array
     */
    protected $rules = array(
        'news_categories_title' => 'required',
        );
    protected $message = array(
        'news_categories_title.required' => 'valid_news_categories_title_required'
    );
}