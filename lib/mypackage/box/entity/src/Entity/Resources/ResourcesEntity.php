<?php namespace Box\Entity\Resources;

use Box\Entity\AbstractEntity;
use Box\Entity\Repository\Resources\ResourcesRepository;
use Box\Entity\EntityInterface;
use Box\Entity\Validation\Resources\ResourcesCreateValidator;
use Box\Entity\Validation\Resources\ResourcesUpdateValidator;

class ResourcesEntity extends AbstractEntity implements EntityInterface {

    /**
     * @var Cribbb\Repository\Resources\ResourcesRepository
     */
    protected $repository;

    /**
     * @var Cribbb\Service\Validation\Laravel\ResourcesCreateValidator
     */
    protected $createValidator;

    /**
     * @var Cribbb\Service\Validation\Laravel\ResourcesUpdateValidator
     */
    protected $updateValidator;

    /**
     * @var Illuminate\Support\MessageBag
     */
    protected $errors;

    /**
     * Construct
     *
     * @param Cribbb\Repository\Resources\ResourcesRepository $repository
     * @param Cribbb\Service\Validation\Laravel\ResourcesCreateValidator $createValidator
     * @param Cribbb\Service\Validation\Laravel\ResourcesUpdateValidator $updateValidator
     */
    public function __construct(ResourcesRepository $repository, ResourcesCreateValidator $createValidator, ResourcesUpdateValidator $updateValidator)
    {
        $this->repository = $repository;
        $this->createValidator = $createValidator;
        $this->updateValidator = $updateValidator;
    }

}