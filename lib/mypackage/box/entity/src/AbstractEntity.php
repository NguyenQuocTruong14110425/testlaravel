<?php namespace Box\Entity;

abstract class AbstractEntity {

    /**
     * All
     *
     * @return Illuminate\Database\Eloquent\Collection
     */
    public function all($pagin = null, $lang = null)
    {
        return $this->repository->all($pagin,$lang);
    }

    /**
     * Fimd
     *
     * @return Illuminate\Database\Eloquent\Model
     */
    public function find($id)
    {
        return $this->repository->find($id);
    }

    /**
     * Create
     *
     * @param array $data
     * @return boolean
     */
    public function create(array $data)
    {
        if( ! $this->createValidator->with($data)->passes() )
        {
            $this->errors = $this->createValidator->errors();
            return false;
        }

        return $this->repository->create($data);
    }

    /**
     * Update
     *
     * @param array $data
     * @return boolean
     */
    public function update(array $data)
    {
        if( ! $this->updateValidator->with($data)->passes() )
        {
            $this->errors = $this->updateValidator->errors();
            return false;
        }

        return $this->repository->update($data);
    }

    /**
     * Delete
     *
     * @return boolean
     */
    public function delete($id)
    {
        return $this->repository->delete($id);
    }

    /**
     * @param $id
     * @return mixed
     */
    public function allTrash($pagin = null, $lang = null)
    {
        return $this->repository->allTrash($pagin,$lang);
    }
    public function trash($id, $trash = true)
    {
        return $this->repository->trash($id, $trash);
    }
    /**
     * Errors
     *
     * @return Illuminate\Support\MessageBag
     */
    public function errors()
    {
        return $this->errors;
    }

    public function errorQuery()
    {
        return $this->repository->withErrors();
    }

}
