<?php namespace Box\Entity\Validation\Resources;

use Box\Entity\Validation\ValidableInterface;
use Box\Entity\Validation\Source\LaravelValidator;

class ResourcesCreateValidator extends LaravelValidator implements ValidableInterface {

    /**
     * Validation for creating a new User
     *
     * @var array
     */
    protected $rules = array(
        'resources_title' => 'required',
    );
    protected $message = array(
        'resources_title.required' => 'valid_resources_title_required'
    );

}