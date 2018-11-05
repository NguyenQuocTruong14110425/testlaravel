<?php namespace Box\Entity\NewsCategories;

use Box\Entity\AbstractEntity;
use Box\Entity\Repository\NewsCategories\NewsCategoriesRepository;
use Box\Entity\EntityInterface;
use Box\Entity\Validation\NewsCategories\NewsCategoriesCreateValidator;
use Box\Entity\Validation\NewsCategories\NewsCategoriesUpdateValidator;

class NewsCategoriesEntity extends AbstractEntity implements EntityInterface {

    /**
     * @var Cribbb\Repository\NewsCategories\NewsCategoriesRepository
     */
    protected $repository;

    /**
     * @var Cribbb\Service\Validation\Laravel\NewsCategoriesCreateValidator
     */
    protected $createValidator;

    /**
     * @var Cribbb\Service\Validation\Laravel\NewsCategoriesUpdateValidator
     */
    protected $updateValidator;

    /**
     * @var Illuminate\Support\MessageBag
     */
    protected $errors;

    /**
     * Construct
     *
     * @param Cribbb\Repository\NewsCategories\NewsCategoriesRepository $repository
     * @param Cribbb\Service\Validation\Laravel\NewsCategoriesCreateValidator $createValidator
     * @param Cribbb\Service\Validation\Laravel\NewsCategoriesUpdateValidator $updateValidator
     */
    public function __construct(NewsCategoriesRepository $repository, NewsCategoriesCreateValidator $createValidator, NewsCategoriesUpdateValidator $updateValidator)
    {
        $this->repository = $repository;
        $this->createValidator = $createValidator;
        $this->updateValidator = $updateValidator;
    }

}